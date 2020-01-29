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
    
    /**
     * Страница создания пользователя
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $options['login'] = '';
        $options['password'] = '';
        $options['role'] = '';
        
        if (isset($_POST['submit'])) {
            $options['login'] = $_POST['login'];
            $options['password'] = $_POST['password'];
            $options['role'] = $_POST['role'];
            
            $errors = false;
            
            if (!Validator::validationUserLogin($options['login'])) {
                $errors[] = 'Логін має містити від 5 до 20 символів';
            }
            
            if (!Validator::validationPassword($options['password'])) {
                $errors[] = 'Пароль має містити від 5 до 15 символів';
            }
            
            if (User::checkUserExists($options['login'], $options['password'])) {
                $errors[] = 'Вказаного користувача вже зареєстровано';
            }
            
            if ($errors == false) {
                User::createUser($options);
                
                header('Location: /admin/user');
            }
        }
        
        require_once ROOT . '/views/admin_user/create.php';
        
        return true;
    }
}
