<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 27/11/2017
 * Time: 09:15 PM
 */

namespace App\Service;


class PageData
{
    public $layout;
    public $leftMenu;
    public $topMenu;
    public $homeTopics;
    public $pageName;
    public $parentURL = null;
    public $parentName = null;


    public function getLayout()
    {
        return $this->layout;
    }


    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }


    public function getLeftMenu()
    {
        return $this->leftMenu;
    }


    public function setLeftMenu($leftMenu)
    {
        $this->leftMenu = $leftMenu;
        return $this;
    }


    public function getTopMenu()
    {
        return $this->topMenu;
    }


    public function setTopMenu($topMenu)
    {
        $this->topMenu = $topMenu;
        return $this;
    }


    public function getHomeTopics()
    {
        return $this->homeTopics;
    }


    public function setHomeTopics($homeTopics)
    {
        $this->homeTopics = $homeTopics;
        return $this;
    }


    public function getPageName()
    {
        return $this->pageName;
    }


    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
        return $this;
    }


    public function getParentURL()
    {
        return $this->parentURL;
    }


    public function setParentURL($parentURL)
    {
        $this->parentURL = $parentURL;
        return $this;
    }


    public function getParentName()
    {
        return $this->parentName;
    }


    public function setParentName($parentName)
    {
        $this->parentName = $parentName;
        return $this;
    }







}