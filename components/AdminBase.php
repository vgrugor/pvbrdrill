<?php

/**
 * Базовый класс для админки
 *
 * @author Zver
 */
class AdminBase {
    
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
}
