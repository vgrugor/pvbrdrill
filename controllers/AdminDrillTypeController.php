<?php

/**
 * Админка типов буровых
 *
 * @author Zver
 */
class AdminDrillTypeController extends AdminBase {
    
    /**
     * Админка со списком типов буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drillTypes = DrillType::getDrillTypesList();
        
        require_once ROOT . '/views/admin_drilltype/index.php';
        
        return true;
    }
    
    /**
     * Страница удаления типа буровой
     * @param int $id <p>id типа буровой, который нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $drillType = DrillType::getDrillTypeById($id);
        
        if (isset($_POST['submit'])) {
            DrillType::deleteDrillTypeById($id);
            
            header('Location: /admin/drilltype');
        }
        
        require_once ROOT . '/views/admin_drilltype/delete.php';
        
        return true;
    }
}
