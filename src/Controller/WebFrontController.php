<?php
/**
 * Created by PhpStorm.
 * User: touhid
 * Date: 02-Oct-17
 * Time: 4:00 PM
 */

namespace App\Controller;


use App\Service\ContentUpdateHelper;
use App\Service\ReaderService;

class WebFrontController extends AppController
{


    public function index()
    {
        $this->set("title", "HMTMCSE | Welcome");
        $this->set("keyword", "Java, PHP, css, js, JavaScript, centos");
        $this->set("metaDescription", "Tutorial for beginner, Java, php, css, js, JavaScript");

        $readerService = new ReaderService();
        $pageData = $readerService->getPage($this->request->url);
        $this->viewBuilder()->setLayout($pageData->getLayout());
        $this->set('pageData', $pageData);
    }

}