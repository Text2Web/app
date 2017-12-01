<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 01/12/2017
 * Time: 04:48 PM
 */

namespace App\Service;


class MDPageContentData
{

    public $title;
    public $metaDescription;
    public $metaKeyword;
    public $pageContent;


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getMetaDescription()
    {
        return $this->metaDescription;
    }


    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }


    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }


    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }


    public function getPageContent()
    {
        return $this->pageContent;
    }


    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;
    }


}