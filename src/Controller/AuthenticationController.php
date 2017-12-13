<?php
namespace App\Controller;

use App\Controller\AppController;


class AuthenticationController extends AppController
{


    public function login(){
        $this->viewBuilder()->setLayout("login");
    }

    public function doLogin(){
        if ($this->request->getData("email") === "hmtm.cse@gmail.com" && $this->request->getData("password") === "password"){
            $this->request->getSession()->write("isLogin", true);
            return $this->redirect(["controller" => "UpdateContent", "action" => "index"]);
        }
        return $this->redirect(["controller" => "Authentication", "action" => "login"]);
    }

    public function logout(){
        $this->request->getSession()->write("isLogin", false);
        $this->request->getSession()->destroy();
        return $this->redirect(["controller" => "Authentication", "action" => "login"]);
    }

}
