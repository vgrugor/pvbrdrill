<?php

/**
 * Description of AdminOrganizationController
 *
 * @author Zver
 */
class AdminOrganizationController extends AdminBase {
    
    public function actionIndex()
    {
        self::checkAdmin();
        
        $organizations = Organization::getOrganizationsList();
        
        require_once ROOT . '/views/admin_organization/index.php';
        
        return true;
    }
}
