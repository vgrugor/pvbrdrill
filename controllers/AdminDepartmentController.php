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
}
