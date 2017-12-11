<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 11/12/2017
 * Time: 09:29 PM
 */

namespace App\Controller;


use Cake\Controller\Controller;

class RestrictedController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout("manage-me");
    }
}