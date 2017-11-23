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

class AppCacheManager
{

    const isCacheEnable = false;

    public static function cleanAll(){
        Cache::delete(MenuHelper::MENU_CACHE);
        Cache::delete(MenuHelper::HOME_PAGE_MENU_CACHE);
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