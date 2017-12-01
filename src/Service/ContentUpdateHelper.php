<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 01/12/2017
 * Time: 11:32 PM
 */

namespace App\Service;


use App\Utils\FileAndDirectoryService;
use App\Utils\PathResolver;

class ContentUpdateHelper
{

    private $authKey = "54a1800736f63d51649038b5a43ed1cd4cf3877f1ac9c";


    public function writeToFile($text){
        $location = PathResolver::getUpdateTemp();
        FileAndDirectoryService::notExistCreateDir($location);
        file_put_contents( $location . DS . uniqid() . "_data.json",$text);
    }

    public function writeUpdateLog($request){
        if (!empty($request->getQuery("authKey")) && $request->getQuery("authKey") == $this->authKey){
            $this->writeToFile(json_encode($request->getData()));
        }
    }


}