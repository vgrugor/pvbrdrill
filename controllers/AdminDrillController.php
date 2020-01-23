<?php

/**
 * Description of AdminDrillController
 *
 * @author Zver
 */
class AdminDrillController extends AdminBase {
    
    /**
     * Админка со списком буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drills = Drill::getDrillsList();
        
        require_once ROOT . '/views/admin_drill/index.php';
        
        return true;
    }
    
    
    /**
     * Страница удаления буровой
     * @param int $id <p>id буровой, которую нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $drill = Drill::getDrillById($id);
        
        if (isset($_POST['submit'])) {
            Drill::deleteDrillById($id);
            
            header('Location: /admin/drill');
        }
        
        require_once ROOT . '/views/admin_drill/delete.php';
        
        return true;
    }
}

