<?php

/**
 * Description of AdminOrganizationController
 *
 * @author Zver
 */
class AdminOrganizationController extends AdminBase {
    
    /**
     * Страница админки со списком организаций
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $organizations = Organization::getOrganizationsList();
        
        require_once ROOT . '/views/admin_organization/index.php';
        
        return true;
    }
    
    /**
     * Страница удаления организации
     * @param int $id <p>id организации, которую нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $organization = Organization::getOrganizationById($id);
        
        if (isset($_POST['submit'])) {
            Organization::deleteOrganizationById($id);
            
            header("Location: /admin/organization");
        }
        
        require_once ROOT . '/views/admin_organization/delete.php';
        
        return true;
    }
}
