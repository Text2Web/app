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

    public static function startsWith($text, $start)
    {
        $length = strlen($start);
        return (substr($text, 0, $length) === $start);
    }

    public static function endsWith($text, $end)
    {
        $length = strlen($end);

        return $length === 0 ||
            (substr($text, -$length) === $end);
    }

    public static function str_replace_first($find, $replace, $text)
    {
        $find = '/'.preg_quote($find, '/').'/';
        return preg_replace($find, $replace, $text, 1);
    }


}