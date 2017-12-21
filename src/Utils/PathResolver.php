<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 02/10/2017
 * Time: 07:35 PM
 */

namespace App\Utils;


class PathResolver
{
    const BITBUCKET_REPO_API = "https://api.bitbucket.org/2.0/repositories/";

    private static $CONTENT_DIR = "content";
    private static $WEB_ROOT = "webroot";
    private static $UPDATE_TEMP_LOG = "updateTempLog";
    private static $CONFIG = "config";
    private static $TMP_CACHE = "tmp" .DS . "cache";


    public static function getContentRoot() {
        return ROOT . DS . self::$CONTENT_DIR;
    }

    public static function getCacheDir() {
        return ROOT . DS . self::$TMP_CACHE;
    }

    public static function getConfigDirectory() {
        return ROOT . DS . self::$CONFIG;
    }

    public static function getConfig() {
        return self::getConfigDirectory() . DS . "config.json";
    }

    public static function getUpdateTemp() {
        return ROOT . DS . self::$UPDATE_TEMP_LOG;
    }

    public static function getWebRoot($path = "")
    {
        return ROOT . DS . self::$WEB_ROOT . DS . $path;
    }

    public static function getMenuInfo($path,  $dirName) {
        return $path . DS . $dirName . DS . AppConstant::INFO_FILE_NAME;
    }

    public static function getMenuInfoByPath($path) {
        return $path . DS .  AppConstant::INFO_FILE_NAME;
    }

    public static function getTopicImage($topicName, $fileName) {
        return self::getContentRoot() . DS . $topicName .  DS . "topic-resources" . DS . $fileName;
    }

    public static function getContentPathByArray($rootPath, $pathArray = array()){
        $linkPath = "";
        foreach ($pathArray as $path){
            $linkPath .= "*" . $path . "*" . DS;
        }
        $linkPath = $rootPath . DS . $linkPath;
        $path = glob(rtrim($linkPath, DS));
        if (count($path) != 0){
            return  rtrim($path[0],DS);
        }
        return null;
    }

    public static function getTopicImageWithWildcard($topicName, $fileName) {
        $realPath = self::getContentRoot() . DS . $topicName .  DS . "topic-resources" . DS . $fileName;
        $path = glob($realPath);
        if (count($path) != 0){
            return $path[0];
        }
        return $realPath;
    }

    public static function getDefaultThumbs()
    {
        return self::getWebRoot("img" . DS . "default_thumbs.jpg");
    }

    public static function concatPath($prefix, $postfix) {
        return $prefix . DS . $postfix;
    }

    public static function getSrcDownload($repositoryName, $slag, $branch){
        return self::BITBUCKET_REPO_API . "$repositoryName/$slag/src/$branch/";
    }

}