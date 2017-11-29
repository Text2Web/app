<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 19/11/2017
 * Time: 07:24 PM
 */

namespace App\View\Helper;

use App\Utils\FileAndDirectoryService;
use App\Utils\AppCacheManager;
use Cake\View\Helper;

class MenuHelper extends Helper
{

    public $helpers = ['Html','Url'];
    const MENU_CACHE = "MENU_CACHE";
    const HOME_PAGE_MENU_CACHE = "HOME_PAGE_MENU_CACHE";

    public function getMenu()
    {
        $fileAndDirectoryService = new FileAndDirectoryService();
        $menuList = $fileAndDirectoryService->getMenuList();
        $html = AppCacheManager::read(self::MENU_CACHE);
        if ($html === false) {
            $url = $this->Url->build('/assets/images');
            $html = "";
            foreach ($menuList as $menu){
                $name = $menu->displayName;
                $parent = $menu->nameOnly;
                $urlImage = "$url/$parent/$parent" . ".png";
                $pageUrl = $this->Url->build("/$parent");
                $html .= "<a href='$pageUrl'>";
                $html .= '<div class="content-block media">';
                $html .= '<div class="media-body text-center">';
                $html .= '<img src= "' . $urlImage .'" class="img-thumbnail"  alt= " ' . $name . '"/>';
                $html .= '<h5>' . $name .'</h5>';
                $html .= '</div></div></a>';
            }
            AppCacheManager::cache(self::MENU_CACHE, $html);
        }
        echo $html;
    }


    public function thumbTextMenuGenerator($parentURL, $parentName, $menuArray){
        $html = "";
        foreach ($menuArray as $subMenu){
            $pageUrl = $this->Url->build("/$parentURL/$subMenu->nameOnly");
            $name = $subMenu->displayName;
            $html .= "<div class='col-sm-6 remove-href-underline'><a href='$pageUrl'><div class='card mt-3'><div class='card-body'>";
            $html .= "<h4 class='card-title'>" . $name .'</h4>';
            $html .= "<div class='badges'><span class='card-subtitle text-muted'>" . $parentName .'</span></div>';
            $html .= '</div></div></a></div>';
        }
        return $html;
    }

    public function getThumbMenu($pageData){
        if ($pageData->getParentURL() !== null && $pageData->getParentName() !== null){
            echo $this->thumbTextMenuGenerator($pageData->getParentURL(), $pageData->getParentName(), $pageData->getHomeTopics());
        }else{
            echo $this->getSubMenu($pageData->getHomeTopics());
        }
    }

    public function getSubMenu($menuList)
    {
        $html = AppCacheManager::read(self::HOME_PAGE_MENU_CACHE);
        if ($html === false) {
            $html = "";
            foreach ($menuList as $menu){
                $pageUrl = $menu->nameOnly;
                if ($menu->subMenues != null){
                    $parentName = $menu->displayName;
                    $html .= $this->thumbTextMenuGenerator($pageUrl, $parentName, $menu->subMenues);
                }
            }
            AppCacheManager::cache(self::HOME_PAGE_MENU_CACHE, $html);
        }
        return $html;
    }

    public function getTopNavItem(){
        $fileAndDirectoryService = new FileAndDirectoryService();
        $menuList = $fileAndDirectoryService->getMenuList();
        $html = AppCacheManager::read(self::MENU_CACHE);
        if ($html === false) {
            $url = $this->Url->build('/');
            $html = '<ul class="navbar-nav bd-navbar-nav flex-row">';
            $html.= '<li class="nav-item">';
            $html.= "<a class='nav-link' href='$url'>Home</a>";
            $html.= '</li>';
            foreach ($menuList as $menu){
                $parentName = $menu->displayName;
                $parent = $menu->nameOnly;
                $pageUrl = $this->Url->build('/' . $menu->nameOnly);
                if ($menu->subMenues != null){
                    $html .= "<li class='nav-item dropdown'>";
                    $html .= "<a class='nav-link dropdown-toggle' href='$pageUrl' data-toggle='dropdown'>";
                    $html .= "$parentName";
                    $html .= "</a>";
                    $html .= "<div class='dropdown-menu'>";
                    foreach ($menu->subMenues as $subMenu){
                        $pageUrl = $this->Url->build("/$parent/$subMenu->nameOnly");
                        $html .= "<a class='dropdown-item' href='$pageUrl'>$subMenu->displayName</a>";
                    }
                    $html .= "</div>";
                    $html .= "</li>";
                }else{
                    $html.= '<li class="nav-item">';
                    $html.= "<a class='nav-link' href='$pageUrl'>$parentName</a>";
                    $html.= '</li>';
                }
            }
            $html .= '</ul>';
            AppCacheManager::cache(self::MENU_CACHE, $html);
        }
        echo $html;
    }
}