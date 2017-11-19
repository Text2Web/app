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

    public $helpers = ['Html'];

    public function getMenu()
    {
        $fileAndDirectoryService = new FileAndDirectoryService();
        $menuList = $fileAndDirectoryService->getMenuList();
        $html = '';
        foreach ($menuList as $menu){
//            print_r($menu);
            $html .= '<a href="#">';
            $html .= '<div class="content-block media">';
            $html .= '<div class="media-body text-center">';
//            $html .= $this->Html->image('default_thumbs.jpg', ['alt' => 'Default', 'class' => 'img-thumbnail']);
            $html .= '<img src= "/app/images/get" class="img-thumbnail" />';
            $html .= '<h5>' . $menu->displayName .'</h5>';
            $html .= '</div></div></a>';
        }
        echo $html;
    }

}