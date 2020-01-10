<?php

/**
 * Description of AdminController
 *
 * @author Zver
 */
class AdminController extends AdminBase {
    
    /**
     * Главная админки
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        require_once ROOT . '/views/admin/index.php';
        
        return true;
    }
}
