<?php

//подключаем файл модели
require_once ROOT . '/models/Drill.php';

class DrillController {
    
    /**
     * 
     * @return boolean
     */
    public function actionIndex() {
        
        //пустая переменная типа массив для получения списка буровых
        $drillList = [];
        
        //вызов метода модели для получения списка буровых
        $drillList = Drill::getDrillList();
        
        require_once ROOT . '/views/drill/index.php';
        
        return true;
    }
    
    public function actionView($id) {
        
        if ($id) {
            $drillItem = Drill::getDrillById($id);
            
            require_once ROOT . '/views/drill/view.php';
        }
        
        return true;
    }
}
