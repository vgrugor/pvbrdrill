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
     * Проверка email
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
    
    /**
     * Проверка, вошел ли пользователь на сайт
     * @return int <p>id пользователя</p>
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }
        
        header("Location: /user/login");
    }
    
    /**
     * Получение информации о пользователе по его id
     * @param type $userId
     * @return 
     */
    public static function getUserById($userId)
    {
        $userId = intval($userId);
        
        if ($userId) {
            
            $db = Db::getConnection();
            
            $sql = 'SELECT * FROM users WHERE id = :userId';
            
            $result = $db->prepare($sql);
            $result->bindParam(':userId', $userId, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }
    
    /**
     * Получение списка пользователей
     * @return array
     */
    public static function getUsersList()
    {
        $db = Db::getConnection();
        
        $users = [];
        
        $sql = 'SELECT id, login, password, role FROM users ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $users[$i]['id'] = $row['id'];
            $users[$i]['login'] = $row['login'];
            $users[$i]['password'] = $row['password'];
            $users[$i]['role'] = $row['role'];
            $i++;
        }
        return $users;
    }
}
