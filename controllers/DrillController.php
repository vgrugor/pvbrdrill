<?php

class DrillController {
    
    /**
     * Общая информация о всех буровых
     * @return boolean
     */
    public function actionGeneral() {
              
        //вызов метода модели для получения списка буровых
        $drillList = Drill::getGeneralInfo();
        
        require_once ROOT . '/views/drill/general.php';
        
        return true;
    }
    
    /**
     * Страница с информацией о интернете на буровых
     * @return boolean <p>Для роутера</p>
     */
    public function actionInternet()
    {
        $internetInfoList = Drill::getInfoAboutInternet();
        
        require_once ROOT . '/views/drill/internet.php';
        
        return true;
    }
    
    /**
     * Страница с ковром бурения
     * @return boolean <p>Для роутера</p>
     */
    public function actionCarpetDrilling()
    {
        $coverInfoList = Drill::getCarpetDrilling();
        
        require_once ROOT . '/views/drill/carpetDrilling.php';
        
        return true;
    }
    
    /**
     * Страница контактов буровых
     * @return boolean <p>Для роутера</p>
     */
    public function actionContacts()
    {
        $contactsList = Drill::getContacts();
        
        require_once ROOT . '/views/drill/contacts.php';
        
        return true;
    }
    
    /**
     * Страница с данными о местонахождении буровой
     * @return boolean <p>Для роутера</p>
     */
    public function actionLocation()
    {
        $locationList = Drill::getLocation();
        
        require_once ROOT . '/views/drill/location.php';
        
        return true;
    }
    
    /**
     * Страница с матрицей расстояний от буровых
     * @return boolean <p>Для роутера</p>
     */
    public function actionDistance()
    {
        require_once ROOT . '/views/drill/distance.php';
        
        return true;
    }

    /**
     * Страница подробной информации о буровой по ее id
     * @param type $id
     * @return boolean <p>Для роутера</p>
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
