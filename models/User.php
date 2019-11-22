<?php

/**
 * Description of User
 *
 * @author rt.hryhoriev
 */
class User {
    
    /**
     * Проверка допустимости логина по длине
     * @param str $login
     * @return boolean
     */
    public static function checkLogin($login)
    {
        if (strlen($login) >= 5) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверка допустимости пароля
     * @param type $password
     * @return boolean
     */
    public static function checkPassword($password)
    {
        if (strlen($password) < 5) {
            return false;
        }
        return true;
    }
    
    /**
     * Проверка, существует ли данный пользователь
     * @param type $login
     * @param type $password
     */
    public static function checkUserExists($login, $password) 
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM users '
                . 'WHERE login = :login '
                . 'AND password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam('password', $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        
        return false;
    }
    
    /**
     * Проходим аутентификацию и создаем переменную сессии с id пользователя
     * @param type $userId
     */
    public static function auth($userId)
    {
        $_SESSION['userId'] = $userId;
    }
    
    /**
     * Является ли пользователь гостем. Для отображения вход/выход
     * @return boolean
     */
    public static function isGuest()
    {
        if (! isset($_SESSION['userId'])) {
            return true;
        }
        return false;
    }
    
}
