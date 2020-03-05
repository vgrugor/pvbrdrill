<?php

class DrillController {
    
    /**
     * Общая информация о всех буровых
     * @return boolean
     */
    public function actionIndex() {
        
        //пустая переменная типа массив для получения списка буровых
        $drillList = [];
        
        //вызов метода модели для получения списка буровых
        $drillList = Drill::getInfoAboutDrills();
        
        require_once ROOT . '/views/drill/index.php';
        
        return true;
    }
    
    /**
     * Страница подробной информации о буровой по ее id
     * @param type $id
     * @return boolean
     */
    public function actionView($id) {
        
        if ($id) {
            
            $drillItem = Drill::getDrillById($id);
            
            $workers = Worker::getWorkersByDrill($id);
            
            require_once ROOT . '/views/drill/view.php';
        }
        
        return true;
    }
}
