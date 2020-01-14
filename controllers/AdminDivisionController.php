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
}
