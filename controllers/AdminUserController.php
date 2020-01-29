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
    
    /**
     * Страница удаления пользователя
     * @param int $id <p>id пользователя, которого необходимо удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $user = User::getUserById($id);
        
        if (isset($_POST['submit'])) {
            User::deleteUserById($id);
            
            header('Location: /admin/user');
        }
        
        require_once ROOT . '/views/admin_user/delete.php';
        
        return true;
    }
}
