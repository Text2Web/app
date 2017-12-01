<?php
namespace App\Controller;


class WebHookController extends AppController
{

    public function pull(){
        return $this->apiResponse(["success" => true]);
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
