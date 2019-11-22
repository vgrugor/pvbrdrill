<?php

/**
 * Description of UserController
 *
 * @author rt.hryhoriev
 */
class UserController {
    
    /**
     * Страница входа
     */
    public function actionLogin() 
    {
        $login = '';
        $password = '';
        
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            $errors = false;

            if (!User::checkLogin($login)) {
                $errors[] = 'Занадто короткий логін';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Занадто короткий пароль';
            }
            
            $userId = User::checkUserExists($login, $password);
            
            if (!$userId) {
                $errors[] = 'Такого користувача не існує!';
            } else {
                User::auth($userId);
                
                header('Location: /');
            }
        }
        require_once ROOT . '/views/user/login.php';

        return true;
    }
    
    public function actionLogout()
    {
        unset($_SESSION['userId']);
        #header('Location: /');
    }
}
