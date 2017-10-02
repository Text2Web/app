<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 02/10/2017
 * Time: 07:08 PM
 */

namespace App\Controller\Component;

use App\Utils\AppConstant;
use App\Utils\PathResolver;
use Cake\Controller\Component;
use DirectoryIterator;
use stdClass;

class FileAndDirectoryComponent extends Component
{


    public function read($filePath){
        if(file_exists($filePath)){
            $content = fopen($filePath, "r");
            if(filesize($filePath) && $content){
                return fread($content, filesize($filePath));
            }
            fclose($content);
            return null;
        }else{
            return null;
        }
    }

    public function getMenuInfo($path){
        $menuInfo = $this->read(PathResolver::getMenuInfoByPath($path));
        if ($menuInfo !== null){
            return json_decode($menuInfo);
        }
        return null;
    }

    public function scanMenuPool($location)
    {
        $menuList = array();
        foreach (new DirectoryIterator($location) as $fileInfo) {
            if ($fileInfo->isDot()) continue;
            if ($fileInfo->isDir()){
                $menuInformation = new stdClass();
                $menuInformation->fileName = $fileInfo->getFilename();
                $menuInformation->menuInfo = $this->getMenuInfo($fileInfo->getPathname());
                $menuInformation->lastModified = $fileInfo->getMTime();
                $menuInformation->subMenues = null;
                if (count(glob($fileInfo->getPathname() . DS . "*")) !== 0){
                    $menuInformation->subMenues = $this->scanMenuPool($fileInfo->getPathname());
                }
                array_push($menuList, $menuInformation);
            }
        }
        return $menuList;
    }

    public function getRootAndSubList(){
        print_r($this->scanMenuPool(PathResolver::getContentRoot()));
    }
}