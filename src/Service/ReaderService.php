<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 24/11/2017
 * Time: 09:21 AM
 */

namespace App\Service;

use App\Utils\AppCacheManager;
use App\Utils\AppUtils;
use App\Utils\FileAndDirectoryService;
use App\Utils\PathResolver;
use Cake\I18n\Formatter\IcuFormatter;
use stdClass;

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
        $pageData->setUrlFragments($urlFragments);
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

    private function readPageMeta($data){
        preg_match_all("/\[\/\/]\s*:\s*#\s*\(([\w:\s]+)\)/", $data, $match);
        $metaData = new stdClass();
        if (count($match) === 2){
            foreach ($match[1] as $row){
                $keyValue = explode(":::", $row);
                if (count($keyValue) === 2){
                    $metaData->{strtolower(trim($keyValue[0]))} = trim($keyValue[1]);
                }
            }
        }
        return $metaData;
    }

    private function getMarkdownContent($path){
        $fileAndDirectoryService = new FileAndDirectoryService();
        $pageData = new stdClass();
        $pageData->content = null;
        $pageData->metaData = null;
        $mdContent = $fileAndDirectoryService->read($path);
        if (!empty($mdContent)){
            $parsedown = new Parsedown();
            $pageData->content = $parsedown->text($mdContent);
            $pageData->metaData = $this->readPageMeta($mdContent);
        }
        return $pageData;
    }

    public function getPageContent($pageData){
        $pageContentData = new MDPageContentData();
        $contentRoot = PathResolver::getContentRoot();
        $path = PathResolver::getContentPathByArray($contentRoot, $pageData->getUrlFragments());
//        $data = AppCacheManager::read($path ? $path : "Empty_PAGE");
//        if ($data == false){
            $pageContentData->pageContent = "<h1 class='text-center'>Content Not Available.</h1>";
            if (!FileAndDirectoryService::isFile($path) && FileAndDirectoryService::isDirectory($path)){
                if (isset($pageData->chapter[0])){
                    $chapter =  $pageData->chapter;
                    $path = PathResolver::concatPath($path, $chapter[0]->fileName);
                }
            }


            $pageMD = $this->getMarkdownContent($path);
            if ($pageMD->content !== null){
                $pageContentData->pageContent = $pageMD->content;
            }
            $humanReadableFragment = "";
            $urlFragments = $pageData->getUrlFragments();
            foreach ($urlFragments as $segment){
                $humanReadableFragment .= AppUtils::humanReadableName($segment) . " ";
            }
            $humanReadableFragment = trim($humanReadableFragment);
            $pageContentData->title = AppUtils::humanReadableName(end($urlFragments));
            $pageContentData->metaDescription = "Tutorial About " . $humanReadableFragment;
            $pageContentData->metaKeyword = strtolower($humanReadableFragment);
            if ($pageMD->metaData !== null){
                $pageContentData->title = isset($pageMD->metaData->title)? $pageMD->metaData->title : $pageContentData->title;
                $pageContentData->metaDescription = isset($pageMD->metaData->description)? $pageMD->metaData->description : $pageContentData->metaDescription;
                $pageContentData->metaKeyword = isset($pageMD->metaData->keyword)? $pageMD->metaData->keyword : $pageContentData->metaKeyword;
            }
            AppCacheManager::cache($path, serialize($pageContentData));
//        }{
//            $pageContentData = unserialize($data);
//        }
        return $pageContentData;
    }

}