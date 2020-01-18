<?php

/**
 * Состояния интернета на буровых
 *
 * @author Zver
 */
class AdminInternetStatusController extends AdminBase {
    
    /**
     * Страница админка состояний интернета на буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $internetStatuses = InternetStatus::getInternetStatusesList();
        
        require_once ROOT . '/views/admin_internetstatus/index.php';
        
        return true;
    }
}
