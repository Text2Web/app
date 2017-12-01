<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 24/11/2017
 * Time: 09:21 AM
 */

namespace App\Service;

use App\Utils\AppUtils;
use App\Utils\FileAndDirectoryService;
use App\Utils\PathResolver;

class ReaderService
{

    const CHAPTER_PAGE = 1;
    const TOPIC_PAGE = 1;
    const HOME_PAGE = 0;
    const DEFAULT_LAYOUT = "card";
    const TUTORIAL_LAYOUT = "tutorial";

    public function getPage($url){
        $contentRoot = PathResolver::getContentRoot();
        $url = rtrim($url,'/');
        $urlFragments = empty($url)? array() : explode("/", $url);
        $pageData = new PageData();
        $numberOfFragment = count($urlFragments);
        if ($numberOfFragment === self::HOME_PAGE){
            $pageData->setLayout(self::DEFAULT_LAYOUT);
            $pageData->setHomeTopics($this->getMenuList($contentRoot));
        }else if ($numberOfFragment === self::CHAPTER_PAGE){
            $pageData->setLayout(self::DEFAULT_LAYOUT);
            $parent = $urlFragments[0];
            $path = PathResolver::getContentPathByArray($contentRoot, $urlFragments);
            $pageData->setHomeTopics($this->getMenuList($path));
            $pageData->setParentURL($parent);
            $pageData->setParentName(AppUtils::humanReadableName($parent));
        }else{
            $pageData->setLayout(self::TUTORIAL_LAYOUT);
            $path = PathResolver::getContentPathByArray($contentRoot, [$urlFragments[0],$urlFragments[1]]);
            $parent = $urlFragments[0] . "/" . $urlFragments[1];
            $pageData->setChapter($this->getMenuList($path));
            $pageData->setParentURL($parent);
        }
        return $pageData;
    }

    public function getMenuList($location){
        $fileDirectoryService = new FileAndDirectoryService();
        return $fileDirectoryService->scanMenuPool($location);
    }

}