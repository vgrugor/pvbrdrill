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
}
