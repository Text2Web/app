<?php
/**
 * Created by PhpStorm.
 * User: touhid
 * Date: 02-Oct-17
 * Time: 4:00 PM
 */

namespace App\Controller;


use App\Service\ReaderService;

class WebFrontController extends AppController
{


    public function index()
    {
        $readerService = new ReaderService();
        $pageData = $readerService->getPage($this->request->url);
        $this->viewBuilder()->setLayout($pageData->getLayout());
        $this->set('pageData', $pageData);
    }

}