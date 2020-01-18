<?php

/**
 * Админка типов буровых
 *
 * @author Zver
 */
class AdminDrillTypeController extends AdminBase {
    
    /**
     * Админка со списком типов буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drillTypes = DrillType::getDrillTypesList();
        
        require_once ROOT . '/views/admin_drilltype/index.php';
        
        return true;
    }
}
