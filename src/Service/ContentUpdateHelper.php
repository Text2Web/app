<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 01/12/2017
 * Time: 11:32 PM
 */

namespace App\Service;


use App\Utils\AppUtils;
use App\Utils\FileAndDirectoryService;
use App\Utils\PathResolver;

class ContentUpdateHelper
{

    private $authKey = "54a1800736f63d51649038b5a43ed1cd4cf3877f1ac9c";
    const CHANGED = "CHANGED";
    const NEW_FILE = "NEW_FILE";
    const DELETE = "DELETE";
    const INVALID = "INVALID";


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

    public static function parseGitDiff(){
        $location = PathResolver::getUpdateTemp() . DS . "git_log.txt";
        $fileAndDirectoryService = new FileAndDirectoryService();
        $logContent = $fileAndDirectoryService->read($location);

        echo "<pre>";
        preg_match_all("/diff\s+--git\s+(.+)\n(.+)/", $logContent, $match);
        $gitUpdateLogs = array();
        if (is_array($match)){
            if (isset($match[1]) && isset($match[2]) && count($match[1]) === count($match[2])){
                $modifications = $match[2];
                $files = $match[1];
                foreach ($files as $key => $file){
                    $fileName = explode(" ", trim($file));
                    $fileName =  AppUtils::str_replace_first("a/", "", $fileName[0]);
                    $modifyType = self::CHANGED;
                    if (!isset($modifications[$key])){
                        $modifyType = self::INVALID;
                    }else{
                        if (AppUtils::startsWith($modifications[$key], "new")){
                            $modifyType = self::NEW_FILE;
                        }elseif(AppUtils::startsWith($modifications[$key], "deleted")){
                            $modifyType = self::DELETE;
                        }elseif(AppUtils::startsWith($modifications[$key], "index")){
                            $modifyType = self::CHANGED;
                        }else{
                            $modifyType = self::INVALID;
                        }
                    }
                    array_push($gitUpdateLogs, array(
                        "fileName" => $fileName,
                        "modifyType" => $modifyType,
                    ));
                }
            }
        }
        print_r($gitUpdateLogs);

        echo "<br><br>";
//        echo $logContent;


    }


}