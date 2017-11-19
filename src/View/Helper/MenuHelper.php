<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 19/11/2017
 * Time: 07:24 PM
 */

namespace App\View\Helper;

use App\Utils\FileAndDirectoryService;
use Cake\View\Helper;

class MenuHelper extends Helper
{

    public $helpers = ['Html','Url'];

    public function getMenu()
    {
        $fileAndDirectoryService = new FileAndDirectoryService();
        $menuList = $fileAndDirectoryService->getMenuList();
        $html = '';
        $url = $this->Url->build('/assets/images');
        $parent = "";
        foreach ($menuList as $menu){
            $name = $menu->displayName;
            $parent = $menu->nameOnly;
            $url .= "/$parent/$parent" . ".png";
            $html .= '<a href="#">';
            $html .= '<div class="content-block media">';
            $html .= '<div class="media-body text-center">';
            $html .= '<img src= "' . $url .'" class="img-thumbnail"  alt= " ' . $name . '"/>';
            $html .= '<h5>' . $name .'</h5>';
            $html .= '</div></div></a>';
        }
        echo $html;
    }

}