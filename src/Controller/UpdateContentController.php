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
        ini_set('max_execution_time', 300);
        $updateContent = new ContentUpdateService();
        $updateContent->scanLogDirAndDownloadDiff();
        return $this->redirect(['controller' => 'UpdateContent', 'action' => 'index']);
    }

    public function downloadFiles(){
        ini_set('max_execution_time', 300);
        $updateContent = new ContentUpdateService();
        $updateContent->updateContent($this->request->getQuery("log"));
        return $this->redirect(['controller' => 'UpdateContent', 'action' => 'index']);
    }

}
