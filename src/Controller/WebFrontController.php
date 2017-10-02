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

    public function index()
    {
        echo "Touhid";
        $this->render();
    }

}