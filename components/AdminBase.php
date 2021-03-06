<?php

/**
 * Базовый класс для админки
 *
 * @author Zver
 */
class AdminBase {
    
    public $validator;
    public $breadcrumb;

    public function __construct() {
        $this->validator = new Validator;
        $this->breadcrumb = new Breadcrumb();
    }

    /**
     * Проверка, является ли пользователь администратором
     * @return boolean <p>Если да, то true</p>
     */
    public function checkAdmin()
    {
        $userId = User::checkLogged();
        
        $user = User::getUserById($userId);
        
        if ($user['role'] == 'admin') {
            return true;
        }
        
        die('У Вас недостатньо прав!!!');
    }
    
    /**
     * Получить путь к файлу header для админпанели
     * @return string <p>путь к вайлу с header</p>
     */
    public function getAdminHeader()
    {
        return ROOT . '/views/layouts/admin_header.php';
    }
    
    /**
     * Получить путь к файлу footer для админпанели
     * @return string <p>путь к вайлу с footer</p>
     */
    public function getAdminFooter()
    {
        return ROOT . '/views/layouts/admin_footer.php';
    }
}
