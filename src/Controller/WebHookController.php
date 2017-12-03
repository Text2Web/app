<?php
namespace App\Controller;


use App\Service\ContentUpdateService;

class WebHookController extends AppController
{

    public function pull(){
        $contentUpdate = new ContentUpdateService();
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
