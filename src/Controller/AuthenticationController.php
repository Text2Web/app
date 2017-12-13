<?php
namespace App\Controller;

use App\Controller\AppController;


class AuthenticationController extends AppController
{


    public function login(){
        $this->viewBuilder()->setLayout("login");
    }

    public function logout(){

    }

}
