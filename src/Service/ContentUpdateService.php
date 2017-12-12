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
use App\Utils\HttpConnection;
use App\Utils\PathResolver;
use stdClass;

class ContentUpdateService
{

    private $authKey = "54a1800736f63d51649038b5a43ed1cd4cf3877f1ac9c";
    const CHANGED = "CHANGED";
    const NEW_FILE = "NEW_FILE";
    const DELETE = "DELETE";
    const INVALID = "INVALID";

    public function scanLogDirAndDownloadDiff(){
        $fileAndDirectoryService = new FileAndDirectoryService();
        $files = $fileAndDirectoryService->scanDirectory(PathResolver::getUpdateTemp(), false, "json");
        foreach ($files as $file){
            $json = $fileAndDirectoryService->getJsonFromFile($file->path);
            if (isset($json->push->changes)){
                foreach ($json->push->changes as $change){
                    if ($change->links->diff->href){
                        $headers = array(
                            'Content-Type:application/json',
                            'Authorization: Basic '. base64_encode("user:pass")
                        );
                        $httpResponse = HttpConnection::makeCurlCall($change->links->diff->href, "GET", null, null, $headers);
                        if ($httpResponse["code"] === 200){
                            $fileChanged = $this->parseGitDiff($httpResponse["response"]);
                            if (count($fileChanged) !== 0){
                                $this->writeToFile(json_encode($fileChanged), ".git");
                            }
                        }
                    }
                }
            }
        }
    }

    public function writeToFile($text, $extension = ".json"){
        $location = PathResolver::getUpdateTemp();
        FileAndDirectoryService::notExistCreateDir($location);
        file_put_contents( $location . DS . uniqid() . $extension, $text);
    }

    public function writeUpdateLog($request){
        if (!empty($request->getQuery("authKey")) && $request->getQuery("authKey") == $this->authKey){
            $this->writeToFile(json_encode($request->getData()));
        }
    }

    public function parseGitDiff($logContent){
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
        return $gitUpdateLogs;
    }

    public function getUpdateLogList(){
        $fileAndDirectoryService = new FileAndDirectoryService();
        $path = PathResolver::getUpdateTemp();
        $files = $fileAndDirectoryService->scanDirectory($path, false, "json");
        $logList = array();
        foreach ($files as $log){
            $info = new stdClass();
            $jsonObject = $fileAndDirectoryService->getJsonFromFile($log->path);
            $changes = $jsonObject->push->changes[0];
            $info->fileName = $log->name;
            $info->commitsMessage = trim($changes->commits[0]->message);

            $time = strtotime( trim($changes->commits[0]->date));
            $dateInLocal = date("H:i:s d-m-Y ", $time);

            $info->date = $dateInLocal;
            $info->commitsLog = trim($changes->commits[0]->hash);
            $info->files = array();
            $gitFile = $path .DS . "$info->commitsLog.git";
            if (file_exists($gitFile)){
                $info->files =  $fileAndDirectoryService->getJsonFromFile($gitFile);
            }
            array_push($logList, $info);
        }
       return $logList;
    }


}