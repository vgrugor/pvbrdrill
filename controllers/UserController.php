<?php

/**
 * Description of UserController
 *
 * @author rt.hryhoriev
 */
class UserController {
    
    /**
     * Отображение страницы для регистрации
     */
    public function actionRegister() {
        
        require ROOT . '/views/user/register.php';
        
        return true;
    }
}
