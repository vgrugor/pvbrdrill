<?php

/**
 * Description of AdminDrillController
 *
 * @author Zver
 */
class AdminDrillController extends AdminBase {
    
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drills = Drill::getDrillsList();
        
        require_once ROOT . '/views/admin_drill/index.php';
        
        return true;
    }
}

