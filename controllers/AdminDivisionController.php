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
}
