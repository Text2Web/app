<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 20/11/2017
 * Time: 11:04 PM
 */

namespace App\Utils;


use App\View\Helper\MenuHelper;
use Cake\Cache\Cache;
use DirectoryIterator;

class AppCacheManager
{

    const isCacheEnable = false;

    public static function cleanAll(){
        if (file_exists(PathResolver::getCacheDir())){
            foreach (new DirectoryIterator(PathResolver::getCacheDir()) as $fileInfo) {
                if ($fileInfo->isDot()) continue;
                if (
                    $fileInfo->getFilename() === "models" ||
                    $fileInfo->getFilename() === "persistent" ||
                    $fileInfo->getFilename() === "views"
                ){
                    continue;
                }
                unlink($fileInfo->getPathname());
            }
        }
    }

    public static function cache($cacheKey, $cacheValue){
        if (self::isCacheEnable){
            return  Cache::write($cacheKey, $cacheValue);
        }
        return false;
    }

    public static function read($cacheKey){
        return Cache::read($cacheKey);
    }

    public static function clean($cacheKey){
        Cache::delete($cacheKey);
    }

}