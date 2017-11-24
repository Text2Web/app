<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 24/11/2017
 * Time: 09:21 AM
 */

namespace App\Service;

class ReaderService
{

    const CHAPTER_PAGE = 2;
    const HOME_PAGE = 2;

    public function getPage($url){
        $urlFragments = explode("/", rtrim($url,'/'));
        $numberOfFragment = count($urlFragments);

        if ($numberOfFragment === self::CHAPTER_PAGE){

        }else if ($numberOfFragment >= self::CHAPTER_PAGE){

        }else{

        }


    }

}