<?php

class WorkerController {
    
    /**
     * Отображение информации о всех работниках
     * @return boolean
     */
    public function actionList() {
        
        $workerList = [];
        
        $workerList = Worker::getWorkerList();
        
        require_once ROOT . '/views/worker/list.php';
        
        return true;
    }
    
    /**
     * Подробно о работнике по его id
     * @param int $id
     * @return boolean
     */
    public function actionView($id){
        
        if ($id) {
            $workerItem = Worker::getWorkerById($id);
            
            require_once ROOT . '/views/worker/view.php';
        }
        
        return true; 
    }
}
