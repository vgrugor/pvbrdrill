<?php

/**
 * Админка для управления пользователями
 *
 * @author Zver
 */
class AdminUserController extends AdminBase {
    
    /**
     * Админка управления пользователями
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $users = User::getUsersList();
        
        require_once ROOT . '/views/admin_user/index.php';
        
        return true;
    }
}
