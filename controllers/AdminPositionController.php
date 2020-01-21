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
}
