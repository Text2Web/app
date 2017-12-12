<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Service\ContentUpdateService;

class UpdateContentController extends RestrictedController
{


    public function index(){

        $updateContent = new ContentUpdateService();
        $updateLogs = $updateContent->getUpdateLogList();
        $this->set("updateLogs", $updateLogs);
    }

}
