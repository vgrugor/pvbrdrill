<?php

/**
 * Управление отделами
 *
 * @author Zver
 */
class AdminDepartmentController extends AdminBase {
    
    /**
     * Главная страница админки со списком отделов
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $departments = Department::getDepartmentsList();
        
        require_once ROOT . '/views/admin_department/index.php';
        
        return true;
    }
    
    /**
     * Удаление отдела по его id
     * @param int $id <p>id отдела, который нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $department = Department::getDepartmentById($id);
        
        if (isset($_POST['submit'])) {
            Department::deleteDepartmentById($id);
            
            header("Location: /admin/department");
        }
        
        require_once ROOT . '/views/admin_department/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания отдела
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $organizationsList = Organization::getOrganizationsList();
        
        $options['organization_id'] = '';
        $options['name'] = '';
        $options['phone_number'] = '';
        $options['note'] = '';
        
        if (isset($_POST['submit'])) {
            $options['organization_id'] = $_POST['organization_id'];
            $options['name'] = $_POST['name'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['note'] = $_POST['note'];
            
            $errors = false;
            
            if(!$this->validator->make($options['name'], ['string', 5, 100])) {
                $errors[] = 'Назва відділу має містити від 5 до 100 символів';
            }
            
            if (!$this->validator->make($options['phone_number'], ['mobileNumber'])) {
                $errors[] = 'Номер телефону не відповідає встановленому формату';
            }
            
            if ($errors == false) {
                Department::createDepartment($options);
                
                header('Location: /admin/department');
            }
        }
        require_once ROOT . '/views/admin_department/create.php';
        
        return true;
    }
    
    /**
     * Заполнение выпадающего списка отделов через ajax
     * @param int $id <p>id организации, чьи отделы нужно выбрать</p>
     * @return boolean
     */
    public function actionAjaxlist($id)
    {
        $departments = Department::getDepartmentsList($id);
        
        require_once ROOT . '/views/admin_department/ajaxlist.php';
        
        return true;
    }
    
    /**
     * Страница редактирования отдела
     * @param integer $id <p>id отдела, данные о котором нужно отредактировать</p>
     * @return boolean <p>для роутера</p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $organizations = Organization::getOrganizationsList();
        $department = Department::getDepartmentById($id);
        
        if (isset($_POST['submit'])) {
            $department['organization_id'] = $_POST['organization_id'];
            $department['name'] = $_POST['name'];
            $department['phone_number'] = $_POST['phone_number'];
            $department['note'] = $_POST['note'];
            
            $errors = false;
            
            if(!$this->validator->make($department['name'], ['string', 5, 100])) {
                $errors[] = 'Назва відділу має містити від 5 до 100 символів';
            }
            
            if (!$this->validator->make($department['phone_number'], ['mobileNumber'])) {
                $errors[] = 'Номер телефону не відповідає встановленому формату';
            }
            
            if ($errors == false) {
                Department::updateDepartmentById($id, $department);
                
                header('Location: /admin/department');
            }
        }
        
        require_once ROOT . '/views/admin_department/update.php';
        
        return true;
    }
}
