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
            
            if (!$this->validator->make($options['name'], ['string', 5, 50])) {
                $errors[] = 'Назва організації має містити від 5 до 50 символів.';
            }
            
            if (!$this->validator->make($options['address'], ['string', 0, 200])) {
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
    
    /**
     * Страница редактирования организации
     * @param integer $id <p>id редактируемой организации</p>
     * @return boolean <p>для роутера</p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $organization = Organization::getOrganizationById($id);
        
        if (isset($_POST['submit'])) {
            $organization['name'] = $_POST['name'];
            $organization['address'] = $_POST['address'];
            $organization['note'] = $_POST['note'];
            
            $errors = false;
            
            if (!$this->validator->make($organization['name'], ['string', 5, 50])) {
                $errors[] = 'Назва організації має містити від 5 до 50 символів.';
            }
            
            if (!$this->validator->make($organization['address'], ['string', 0, 200])) {
                $errors[] = 'Адреса має містити до 200 символів.';
            }
            
            if ($errors == false) {
                Organization::updateOrganizationById($id, $organization);
                
                header('Location: /admin/organization');
            }
        }
        
        require_once ROOT . '/views/admin_organization/update.php';
        
        return true;
    }
}
