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
    private static $CONTENT_DIR = "content";


    public static function getContentRoot() {
        return ROOT . DS . self::$CONTENT_DIR;
    }

    public static function getMenuInfo($path,  $dirName) {
        return $path . DS . $dirName . DS . AppConstant::INFO_FILE_NAME;
    }

    public static function getMenuInfoByPath($path) {
        return $path . DS .  AppConstant::INFO_FILE_NAME;
    }


}