<?php
namespace App\Controller;


use App\Service\ContentUpdateHelper;

class WebHookController extends AppController
{

    public function pull(){
        $contentUpdate = new ContentUpdateHelper();
        $contentUpdate->writeUpdateLog($this->request);
        echo "Added";
        die();
    }

    public function index(){
        echo "WebHook";
        die();
    }

    public function apiResponse($object){
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($object));
    }

}
