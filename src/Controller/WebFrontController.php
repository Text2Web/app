<?php
/**
 * Created by PhpStorm.
 * User: touhid
 * Date: 02-Oct-17
 * Time: 4:00 PM
 */

namespace App\Controller;


class WebFrontController extends AppController
{

    public $components = array('FileAndDirectory');

    public function index()
    {
        echo "<pre>";
        print_r($this->FileAndDirectory->getRootAndSubList());

        die();

//        $this->render();
    }

}