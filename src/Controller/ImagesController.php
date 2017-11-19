<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 19/11/2017
 * Time: 08:08 PM
 */

namespace App\Controller;


use App\Utils\PathResolver;

class ImagesController extends AppController
{

    public function index(){
        return $this->response->withFile(PathResolver::getTopicImage("1.java", "java.png"));
    }
}