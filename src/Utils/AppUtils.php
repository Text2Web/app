<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 29/11/2017
 * Time: 06:12 AM
 */

namespace App\Utils;


class AppUtils
{

    public static function humanReadableName($name){
        $splitString = trim($name, ' ');
        $explodeDot = explode('.', $splitString);
        $realName = isset($explodeDot[1])?$explodeDot[1]:$name;
        $realName = ucwords(preg_replace("/[_-]/", " ", $realName));
        return $realName;
    }

}