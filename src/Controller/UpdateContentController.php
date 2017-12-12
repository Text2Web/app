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

    public function downloadChangFileLog(){
        $updateContent = new ContentUpdateService();
        $updateContent->scanLogDirAndDownloadDiff();
        return $this->redirect(['controller' => 'UpdateContent', 'action' => 'index']);
    }

}
