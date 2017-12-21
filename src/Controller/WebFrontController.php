<?php
/**
 * Created by PhpStorm.
 * User: touhid
 * Date: 02-Oct-17
 * Time: 4:00 PM
 */

namespace App\Controller;



use App\Service\ReaderService;
use Cake\Routing\Router;


class WebFrontController extends AppController
{

    public $helpers = ['Html','Url'];

    public function index()
    {
        $this->set("title", "HMTMCSE | Welcome");
        $this->set("keyword", "Java, PHP, CSS, JavaScript, CentOS");
        $this->set("metaDescription", "Tutorial for Beginner, Java, PHP, CSS, JavaScript");

        $requestedURL = $this->request->url;
        $pageURL = Router::url($requestedURL, true);
        $this->set("canonicalName", $pageURL);

        $readerService = new ReaderService();
        $pageData = $readerService->getPage($requestedURL);
        $this->viewBuilder()->setLayout($pageData->getLayout());
        $this->set('pageData', $pageData);
        $this->set('pageURL', $pageURL);
    }

}