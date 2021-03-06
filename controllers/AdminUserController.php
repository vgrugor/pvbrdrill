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
            
            if (!$this->validator->make($options['login'], ['string', 5, 20])) {
                $errors[] = 'Логін має містити від 5 до 20 символів';
            }
            
            if (!$this->validator->make($options['password'], ['string', 5, 15])) {
                $errors[] = 'Пароль має містити від 5 до 15 символів';
            }
            
            if (User::checkUserExists($options['login'], $options['password'])) {
                $errors[] = 'Користувача з таким логіном і паролем вже зареєстровано';
            } elseif (User::checkLoginExists($options['login'])) {
                $errors[] = 'Користувач з таким логіном вже існує';
            }
            
            if ($errors == false) {
                User::createUser($options);
                
                header('Location: /admin/user');
            }
        }
        
        require_once ROOT . '/views/admin_user/create.php';
        
        return true;
    }
    
    /**
     * Страница редактирования пользователя
     * @param integer $id <p>id пользователя, информацию о котором нужно отредактировать</p>
     * @return boolean <p>для роутера</p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $user = User::getUserById($id);
        
        if (isset($_POST['submit'])) {
            $user['login'] = $_POST['login'];
            $user['password'] = $_POST['password'];
            $user['role'] = $_POST['role'];
            
            $errors = false;
            
            if (!$this->validator->make($user['login'], ['string', 5, 20])) {
                $errors[] = 'Логін має містити від 5 до 20 символів';
            }
            
            if (!$this->validator->make($user['password'], ['string', 5, 15])) {
                $errors[] = 'Пароль має містити від 5 до 15 символів';
            }
            
            if (!$this->validator->make($user['login'], ['loginForUpdate', $user['id']])) {
                $errors[] = 'Інший користувач з таким логіном вже існує';
            }
            
            if ($errors == false) {
                User::updateUserById($id, $user);
                
                header('Location: /admin/user');
            }
        }
        require_once ROOT . '/views/admin_user/update.php';
        
        return true;
    }
}
