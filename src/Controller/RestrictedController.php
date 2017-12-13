<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 11/12/2017
 * Time: 09:29 PM
 */

namespace App\Controller;


use Cake\Controller\Controller;
use Cake\Event\Event;

class RestrictedController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout("manage-me");
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getSession()->read("isLogin")){
            return null;
        }else{
            return $this->redirect(["controller" => "Authentication", "action"=>"login"]);
        }
    }
}