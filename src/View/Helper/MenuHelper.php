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
                $urlInternal = "$url/$parent/$parent" . ".png";
                $html .= '<a href="#">';
                $html .= '<div class="content-block media">';
                $html .= '<div class="media-body text-center">';
                $html .= '<img src= "' . $urlInternal .'" class="img-thumbnail"  alt= " ' . $name . '"/>';
                $html .= '<h5>' . $name .'</h5>';
                $html .= '</div></div></a>';
            }
            AppCacheManager::cache(self::MENU_CACHE, $html);
        }
        echo $html;
    }

    public function getSubMenu()
    {
        $fileAndDirectoryService = new FileAndDirectoryService();
        $menuList = $fileAndDirectoryService->getMenuList();
        $html = AppCacheManager::read(self::HOME_PAGE_MENU_CACHE);
        if ($html === false) {
            $html = "";
            foreach ($menuList as $menu){
                $pageUrl = $menu->nameOnly;
                if ($menu->subMenues != null){
                    $parentName = $menu->displayName;
                    foreach ($menu->subMenues as $subMenu){
                        $pageUrl = $this->Url->build("/$pageUrl/$subMenu->nameOnly");
                        $name = $subMenu->displayName;
                        $html .= "<a href='$pageUrl'><div class='content-block'>";
                        $html .= "<a href='$pageUrl'><h5>" . $name .'</h5></a>';
                        $html .= "<span class='badges'><a href='$pageUrl'>" . $parentName .'</a></span>';
                        $html .= '</div></a>';
                    }
                }

            }
            AppCacheManager::cache(self::HOME_PAGE_MENU_CACHE, $html);
        }
        echo $html;
    }
}