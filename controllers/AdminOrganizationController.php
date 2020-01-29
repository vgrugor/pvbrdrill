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
    
    /**
     * Страница создания организации
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $options['name'] = '';
        $options['address'] = '';
        $options['note'] = '';
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['address'] = $_POST['address'];
            $options['note'] = $_POST['note'];
            
            $errors = false;
            
            if (!Validator::validationOrganizationName($options['name'])) {
                $errors[] = 'Назва організації має містити від 5 до 50 символів.';
            }
            
            if (!Validator::validationAddressOrganization($options['address'])) {
                $errors[] = 'Адреса має містити до 200 символів.';
            }
            
            if ($errors == false) {
                Organization::createOrganization($options);
                
                header('Location: /admin/organization');
            }
        }
        
        require_once ROOT . '/views/admin_organization/create.php';
        
        return true;
    }
}