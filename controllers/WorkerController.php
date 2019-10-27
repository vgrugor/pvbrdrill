<?php

//подключаем файл модели
require_once ROOT . '/models/Worker.php';

class WorkerController {
    
    public function actionList() {
        
        $workerList = [];
        
        $workerList = Worker::getWorkerList();
        
        require_once ROOT . '/views/worker/list.php';
        
        return true;
    }
    
    public function actionView($id){
        
        if ($id) {
            $workerItem = Worker::getWorkerById($id);
            
            require_once ROOT . '/views/worker/view.php';
        }
        
        return true; 
    }
}
