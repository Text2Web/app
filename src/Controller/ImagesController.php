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

    private function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function index(){
        $image = PathResolver::getDefaultThumbs();
        if ($this->startsWith($this->request->url,"assets/images/")){
            $imagePath = str_replace("assets/images/","",$this->request->url);
            $imagePath = explode("/", $imagePath);
            if (count($imagePath) === 2){
                $imagePath = PathResolver::getTopicImageWithWildcard("*" . $imagePath[0], $imagePath[1]);
                if (file_exists($imagePath)){
                    $image = $imagePath;
                }
            }

        }
        return $this->response->withFile($image);
    }
}