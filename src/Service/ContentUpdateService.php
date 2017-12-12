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
    const DATA_FILE_EXTENSION = "_data.json";

    public function getApiConfig(){
        $config = AppUtils::loadConfig();
        $configObj = new stdClass();
        $configObj->bitbucketUsername = "";
        $configObj->bitbucketPassword = "";
        $configObj->repository = "";
        $configObj->repositorySlag = "";
        $configObj->repositoryBranch = "";
        if ($config !== null &&  $config->bitbucketUsername !== null && $config->bitbucketPassword !== null){
            $configObj->bitbucketUsername = $config->bitbucketUsername;
            $configObj->bitbucketPassword = $config->bitbucketPassword;
            $configObj->repository = $config->repository;
            $configObj->repositorySlag = $config->repositorySlag;
            $configObj->repositoryBranch = $config->repositoryBranch;
        }
        return $configObj;
    }

    public function scanLogDirAndDownloadDiff(){
        $config = $this->getApiConfig();
        $fileAndDirectoryService = new FileAndDirectoryService();
        $files = $fileAndDirectoryService->scanDirectory(PathResolver::getUpdateTemp(), false, "json");
        foreach ($files as $file){
            $json = $fileAndDirectoryService->getJsonFromFile($file->path);
            if (isset($json->push->changes)){
                foreach ($json->push->changes as $change){
                    if ($change->links->diff->href){
                        $headers = array(
                            'Content-Type:application/json',
                            'Authorization: Basic '. base64_encode("$config->bitbucketUsername:$config->bitbucketPassword")
                        );
                        $httpResponse = HttpConnection::makeCurlCall($change->links->diff->href, "GET", null, null, $headers);
                        if ($httpResponse["code"] === 200){
                            $fileChanged = $this->parseGitDiff($httpResponse["response"]);
                            if (count($fileChanged) !== 0){
                                $this->writeToFile(json_encode($fileChanged), ".git", str_replace(self::DATA_FILE_EXTENSION, "", $file->name));
                            }
                        }
                    }
                }
            }
        }
    }

    public function writeToFile($text, $extension = self::DATA_FILE_EXTENSION, $name = null){
        $location = PathResolver::getUpdateTemp();
        FileAndDirectoryService::notExistCreateDir($location);
        $name = $name == null ? uniqid() : $name;
        file_put_contents( $location . DS . $name . $extension, $text);
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
            $info->fileName = str_replace(self::DATA_FILE_EXTENSION, "", $log->name);
            $info->commitsMessage = trim($changes->commits[0]->message);

            $time = strtotime( trim($changes->commits[0]->date));
            $dateInLocal = date("H:i:s d-m-Y ", $time);

            $info->date = $dateInLocal;
            $info->commitsLog = trim($changes->commits[0]->hash);
            $info->files = array();
            $gitFile = $path .DS . "$info->fileName.git";
            if (file_exists($gitFile)){
                $info->files =  $fileAndDirectoryService->getJsonFromFile($gitFile);
            }
            array_push($logList, $info);
        }
       return $logList;
    }

    public function updateContent($log){
        $path = PathResolver::getUpdateTemp();
        $logFile = $path . DS . "$log.git";
        if (FileAndDirectoryService::isFile($logFile)){
            $contentPath = PathResolver::getContentRoot();
            $commitFile = $path . DS . $log . self::DATA_FILE_EXTENSION;
            $fileAndDirectoryService = new FileAndDirectoryService();
            $jsonObject = $fileAndDirectoryService->getJsonFromFile($logFile);
            $config = $this->getApiConfig();
            $downloadURL = PathResolver::getSrcDownload($config->repository, $config->repositorySlag, $config->repositoryBranch);
            $httpConnection = new HttpConnectionService();
            $httpConnection->setBasicAuth($config->bitbucketUsername,$config->bitbucketPassword);
            echo "<pre>";
            foreach ($jsonObject as $file){
                switch ($file->modifyType){
                    case self::CHANGED:
                    case self::NEW_FILE:
                        $httpConnection->DOWNLOAD($downloadURL . $file->fileName, $contentPath . DS . $file->fileName);
                        break;
                    case self::DELETE:
                        $fileAndDirectoryService->deleteRecursive($contentPath . DS . $file->fileName);

                }
            }
            $fileAndDirectoryService->delete($logFile);
            $fileAndDirectoryService->delete($commitFile);
        }
    }


}