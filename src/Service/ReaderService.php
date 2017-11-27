<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 24/11/2017
 * Time: 09:21 AM
 */

namespace App\Service;

use App\Utils\FileAndDirectoryService;
use App\Utils\PathResolver;

class ReaderService
{

    const CHAPTER_PAGE = 1;
    const TOPIC_PAGE = 1;
    const HOME_PAGE = 0;
    const DEFAULT_LAYOUT = "default";
    const TUTORIAL_LAYOUT = "tutorial";

    public function getPage($url){
        $contentRoot = PathResolver::getContentRoot();
        $urlFragments = explode("/", rtrim($url,'/'));
        $path = PathResolver::getContentPathByArray($contentRoot, $urlFragments);
        $pageData = new PageData();
        $numberOfFragment = count($urlFragments);
        if ($numberOfFragment === self::HOME_PAGE){
            $pageData->setLayout(self::DEFAULT_LAYOUT);
            $pageData->setHomeTopics($this->getMenuList($contentRoot));
        }else if ($numberOfFragment === self::CHAPTER_PAGE){
            $pageData->setLayout(self::DEFAULT_LAYOUT);
            $pageData->setHomeTopics($this->getMenuList($contentRoot));
        }else{
            $pageData->setLayout(self::TUTORIAL_LAYOUT);
//            $pageData->setLeftMenu($this->getPage($contentRoot));
        }

        return $pageData;

//        echo $path;
//        print_r($urlFragments);
    }

    public function getMenuList($location){
        $fileDirectoryService = new FileAndDirectoryService();
        return $fileDirectoryService->scanMenuPool($location);
    }

}