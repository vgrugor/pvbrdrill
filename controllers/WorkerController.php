<?php

//подключаем файл модели
require_once ROOT . '/models/Worker.php';

class WorkerController {
    
    public function actionList() {
        
        $workerList = [];
        
        $workerList = Worker::getWorkerList();
        
        echo '<pre>';
        print_r($workerList);
        echo '</pre>';
        
        echo 'Список всех работников';
        
        return true;
    }
    
    public function actionView($id){
        
        if ($id) {
            $workerItem = Worker::getWorkerById($id);
            
            echo '<pre>';
            print_r($workerItem);
            echo '</pre>';
        }
        
        echo 'Просмотр иформации о одном работнике c id = ' . $id;
        
        return true; 
    }
}
