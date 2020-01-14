<?php

/**
 * Администрирование должностей
 *
 * @author rt.hryhoriev
 */
class AdminPositionController extends AdminBase {
    
    /**
     * Админка со списком должностей
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $positions = Position::getPositionsList();
        
        require_once ROOT . '/views/admin_position/index.php';
        
        return true;
    }
}
