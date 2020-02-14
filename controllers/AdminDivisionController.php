<?php


/**
 * Управление подразделениями
 *
 * @author rt.hryhoriev
 */
class AdminDivisionController extends AdminBase {
    
    /**
     * Админка со списком подразделений
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $divisions = Division::getDivisionsList();
        
        require_once ROOT . '/views/admin_division/index.php';
        
        return true;
    }
    
    
    /**
     * Страница удаления подразделения
     * @param int $id <p>id подразделения, которое нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $division = Division::getDivisionById($id);
        
        if (isset($_POST['submit'])) {
            Division::deleteDivisionById($id);
            
            header('Location: /admin/division');
        }
        
        require_once ROOT . '/views/admin_division/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания нового подразделения
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $organizations = [];
        $organizations = Organization::getOrganizationsList();
        #организация, выбранная в select при первой загрузке страницы
        $selectedOrganizations = $organizations[0]['id'];       
        
        $departments = [];
        #список отделом для выбраной организации при первой загрузке страницы
        $departments = Department::getDepartmentsList($selectedOrganizations);
        
        $options['organization_id'] = '';
        $options['department_id'] = '';
        $options['name'] = '';
        $options['note'] = '';
        
        if (isset($_POST['submit'])) {
            $options['organization_id'] = $_POST['organization_id'];
            $options['department_id'] = $_POST['department_id'];
            $options['name'] = $_POST['name'];
            $options['note'] = $_POST['note'];
            
            //список отделов, для выбраной организации
            $departments = Department::getDepartmentsList($options['organization_id']);
            
            $errors = false;
            
            if (!$this->validator->make($options['name'],['string', 4, 100])) {
                $errors[] = 'Назва підрозділу має містити від 4 до 100 символів';
            }
            
            if ($errors == false) {
                Division::createDivision($options);
            
                header('Location: /admin/division');
            }
        }
        require_once ROOT . '/views/admin_division/create.php';
        
        return true;
    }
}
