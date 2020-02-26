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
    
    /**
     * Страница удаления должности
     * @param int $id <p>id должности, которую следует удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $position = Position::getPositionById($id);
        
        if (isset($_POST['submit'])) {
            Position::deletePositionById($id);
            
            header('Location: /admin/position');
        }
        
        require_once ROOT . '/views/admin_position/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания должности
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $organizations = [];
        $organizations = Organization::getOrganizationsList();
        $selectedOrganization = $organizations[0]['id'];
        
        $departments = [];
        $departments = Department::getDepartmentsList($selectedOrganization);
        $selectedDepartment = $departments[0]['id'];
        
        $divisions = [];
        $divisions = Division::getDivisionsList($selectedDepartment);
        
        $options['organization_id'] = '';
        $options['department_id'] = '';
        $options['division_id'] = '';
        $options['name'] = '';
        
        if (isset($_POST['submit'])) {
            
            $options['organization_id'] = $_POST['organization_id'];
            $options['department_id'] = $_POST['department_id'];
            $options['division_id'] = $_POST['division_id'];
            $options['name'] = $_POST['name'];
            
            //список отделов, если должность не прошла валидацию
            $departments = Department::getDepartmentsList($options['organization_id']);
            
            //список подразделений, если должность не прошла валидацию
            $divisions = Division::getDivisionsList($options['department_id']);
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 256])) {
                $errors[] = 'Назва посади має містити від 4 до 256 символів';
            }
            
            if ($errors == false) {
                Position::createPosition($options);
                
                header('Location: /admin/position');
            }
        }
        require_once ROOT . '/views/admin_position/create.php';
        
        return true;
    }
    
    /**
     * Заполняет выпадающий список с названиями должностей
     * @param integer $departmentId <p>id отдела, из которого следует выбрать должности</p>
     * @param integer $divisionId <p>id подразделения, из которого следует выбрать должности</p>
     * @return boolean
     */
    public function actionAjaxlist($departmentId, $divisionId)
    {
        $positions = Position::getPositionsList($departmentId, $divisionId);
        
        require_once ROOT . '/views/admin_position/ajaxlist.php';
        
        return true;
    }
}
