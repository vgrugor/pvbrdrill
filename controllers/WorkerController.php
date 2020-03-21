<?php

class WorkerController {
    
    /**
     * Отображение информации о всех работниках
     * @return boolean
     */
    public function actionList($page = 1) {
        
        $workerList = [];
        
        $workerList = Worker::getWorkerList($page);
        
        $total = Worker::getTotalWorkers();
        $pagination = new Pagination($total, $page, Worker::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT . '/views/worker/list.php';
        
        return true;
    }
    
    /**
     * Подробно о работнике по его id
     * @param int $id
     * @return boolean
     */
    public function actionView($id){
        
        if ($id) {
            
            $workerItem = Worker::getWorkerById($id);
            
            $organization = Organization::getOrganizationById($workerItem['organization_id']);
            
            $department = Department::getDepartmentById($workerItem['department_id']);
            
            $division = Division::getDivisionById($workerItem['division_id']);
            
            require_once ROOT . '/views/worker/view.php';
        }
        
        return true; 
    }
}
