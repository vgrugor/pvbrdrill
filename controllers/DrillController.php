<?php

//подключаем файл модели
require_once ROOT . '/models/Drill.php';

class DrillController {
    
    /**
     * 
     * @return boolean
     */
    public function actionList() {
        
        //пустая переменная типа массив для получения списка буровых
        $drillList = [];
        
        //вызов метода модели для получения списка буровых
        $drillList = Drill::getDrillList();
        
        echo '<pre>';
        print_r($drillList);
        echo '</pre>';
        
        echo 'Список всех буровых';
        
        return true;
    }
    
    public function actionView($id) {
        
        if ($id) {
            $drillItem = Drill::getDrillById($id);
            
            echo '<pre>';
            print_r($drillItem);
            echo '</pre>';
        }
        
        echo 'Просмотр подробной информации о буровой c id = ' . $id;
        
        return true;
    }
}
