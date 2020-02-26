<?php

/**
 * Управление работниками
 *
 * @author rt.hryhoriev
 */
class AdminWorkerController extends AdminBase {
    
    /**
     * Админка со списком работников
     * @return boolean
     */
    public function actionIndex($page = 1)
    {
        self::checkAdmin();
        
        $workers = Worker::getWorkerList($page);
        
        $total = Worker::getTotalWorkers();
        
        $pagination = new Pagination($total, $page, Worker::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT . '/views/admin_worker/index.php';
        
        return true;
    }
    
    /**
     * Страница удаления работника
     * @param type $id <p>id работника, которого нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $worker = Worker::getWorkerById($id);
        
        if (isset($_POST['submit'])) {
            Worker::deleteWorkerById($id);
            
            header("Location: /admin/worker");
        }
        
        require_once ROOT . '/views/admin_worker/delete.php';
        
        return true;
    }
    
    /**
     * Страница добавления сотрудника
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $options['position_id'] = '';
        $options['drill_id'] = '';
        $options['name'] = '';
        $options['account_ad'] = '';
        $options['phone_number'] = '';
        $options['email'] = '';
        $options['vpn_status_id'] = '';
        $options['date_refresh'] = '';
        $options['note'] = '';
        $options['organization_id'] = '';
        $options['department_id'] = '';
        $options['division_id'] = '';
        
        $organizations = Organization::getOrganizationsList();
        $selectedOrganization = reset($organizations);
        $selectedOrganizationId = $selectedOrganization['id'];
        
        $departments = Department::getDepartmentsList($selectedOrganizationId);
        $selectedDepartment = reset($departments);
        $selectedDepartmentId = $selectedDepartment['id'];
        
        $divisions = Division::getDivisionsList($selectedDepartmentId);
        $selectedDivision = reset($divisions);
        $selectedDivisionId = $selectedDivision['id'];
        
        $positions = Position::getPositionsList($selectedDepartmentId, $selectedDivisionId);
        $drills = Drill::getDrillsList();
        $vpnStatuses = VpnStatus::getVpnStatusesList();
        
        if (isset($_POST['submit'])) {
            
            $options['position_id'] = $_POST['position_id'];
            $options['drill_id'] = $_POST['drill_id'];
            $options['name'] = $_POST['name'];
            $options['account_ad'] = $_POST['account_ad'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email'] = $_POST['email'];
            $options['vpn_status_id'] = $_POST['vpn_status_id'];
            $options['date_refresh'] = $_POST['date_refresh'];
            $options['note'] = $_POST['note'];
            $options['organization_id'] = $_POST['organization_id'];
            $options['department_id'] = $_POST['department_id'];
            $options['division_id'] = $_POST['division_id'];
            
            $selectedOrganizationId = $options['organization_id'];
            $departments = Department::getDepartmentsList($selectedOrganizationId);
            
            $selectedDepartmentId = $options['department_id'];
            $divisions = Division::getDivisionsList($selectedDepartmentId);
            
            $selectedDivisionId = $options['division_id'];
            $positions = Position::getPositionsList($selectedDepartmentId, $selectedDivisionId);
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 100])) {
                $errors[] = "Прізвище, ім'я та побатькові має містити від 4 до 100 символів";
            }
            
            if (!$this->validator->make($options['phone_number'], ['mobileNumber'])) {
                $errors[] = 'Номер телефону не відповідає вказаному шаблону';
            }
            
            if (!$this->validator->make($options['email'], ['email'])) {
                $errors[] = 'email не відповідає шаблону';
            }
            
            if (!$this->validator->make($options['date_refresh'], ['date'])) {
                $errors[] = 'Дата оновлення не відповідає встановленому формату';
            }
            
            if ($errors == false) {
                Worker::createWorker($options);
                
                header('Location: /admin/worker');
            }
        }
        require_once ROOT . '/views/admin_worker/create.php';
        
        return true;
    }
}
