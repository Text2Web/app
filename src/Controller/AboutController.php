<?php

namespace App\Controller;
use App\Service\ReaderService;
use App\Utils\PathResolver;
use Cake\Routing\Router;


/**
 * Created by PhpStorm.
 * User: touhid
 * Date: 02-Oct-17
 * Time: 4:10 PM
 */


class AboutController extends AppController
{
    private $layoutName = "tutorial";

    public $helpers = ['Html','Url'];


    public function privacy()
    {
        $this->set("title", "HMTMCSE | Privacy");
        $this->set("keyword", "Java, PHP, CSS, JavaScript, CentOS");
        $this->set("metaDescription", "Tutorial for Beginner, Java, PHP, CSS, JavaScript");
        $readerService = new ReaderService();
        $pageData = $readerService->getMarkdownContent(PathResolver::getPrivacyAboutInfoFile());
        $this->set('pageData', $pageData);
        $this->viewBuilder()->setLayout($this->layoutName);
    }

    public function copyright()
    {
        $this->set("title", "HMTMCSE | Copyright");
        $this->set("keyword", "Java, PHP, CSS, JavaScript, CentOS");
        $this->set("metaDescription", "Tutorial for Beginner, Java, PHP, CSS, JavaScript");
        $readerService = new ReaderService();
        $pageData = $readerService->getMarkdownContent(PathResolver::getCopyrightAboutInfoFile());
        $this->set('pageData', $pageData);
        $this->viewBuilder()->setLayout($this->layoutName);
    }
}