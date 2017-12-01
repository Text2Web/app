<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 19/11/2017
 * Time: 07:24 PM
 */

namespace App\View\Helper;

use App\Service\ReaderService;
use App\Utils\FileAndDirectoryService;
use App\Utils\AppCacheManager;
use Cake\View\Helper;

class UIHelper extends Helper
{

    public $helpers = ['Html','Url'];

    public function getPageContent($pageData){
        $readerService = new ReaderService();
        $pageContentData = $readerService->getPageContent($pageData);
        $this->getView()->set("title", "HMTMCSE | " . $pageContentData->title);
        $this->getView()->set("keyword", $pageContentData->metaKeyword);
        $this->getView()->set("metaDescription", $pageContentData->metaDescription);
        echo $pageContentData->pageContent;
    }


}