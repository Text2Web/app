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

class AppCacheHelper
{

    public static function cleanAll(){
        Cache::delete(MenuHelper::MENU_CACHE);
    }

}