<?php

/**
 * Description of Validator
 *
 * @author Zver
 */
class Validator {
    
    /**
     * Валидация статуса VPN
     * @param string $vpnName <p>название нового статуса</p>
     * @return boolean
     */
    public static function validationVpnStatusName($vpnName)
    {
        $lenVpn = mb_strlen($vpnName);
        if ($lenVpn > 4 && $lenVpn <= 50) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация статуса для интернета
     * @param string $internetStatusName <p>имя нового статуса интернета</p>
     * @return boolean <p>true - прошел валидацию, false - нет</p>
     */
    public static function validationInternetStatusName($internetStatusName)
    {
        $lenInternetStatus = mb_strlen($internetStatusName);
        if ($lenInternetStatus > 4 && $lenInternetStatus <= 50) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация названия типа буровой
     * @param string $drillTypeName <p>название нового типа буровых</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationDrillTypeName($drillTypeName)
    {
        $lenDrillType = mb_strlen($drillTypeName);
        if ($lenDrillType > 4 && $lenDrillType <= 10) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация названия организации
     * @param string $organizationName <p>название организации</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationOrganizationName($organizationName) 
    {
        $lenOrganization = mb_strlen($organizationName);
        if ($lenOrganization > 4 && $lenOrganization <= 50) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация адреса организации
     * @param string $addressOrganization <p>адрес организации</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationAddressOrganization($addressOrganization)
    {
        $lenAddressOrganization = mb_strlen($addressOrganization);
        if ($lenAddressOrganization <= 200) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация названия отдела
     * @param string $departmentName <p>название нового отдела</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationDepartmentName($departmentName)
    {
        $lenDepartmentName = mb_strlen($departmentName);
        
        if ($lenDepartmentName > 4 && $lenDepartmentName <= 100) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация мобильного телефона (ХХХ)ХХХ-ХХ-ХХ
     * @param string $phoneNumber <p>номер телефона</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationMobilePhoneNumber($phoneNumber)
    {
        $pattern = "~^\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$~";
        if (preg_match($pattern, $phoneNumber) || $phoneNumber == "") {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация логина
     * @param type $login <p>логин пользователя</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationUserLogin($login)
    {
        $lenLogin = mb_strlen($login);
        if ($lenLogin > 4 && $lenLogin <= 20) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация пароля пользователя
     * @param string $password <p>пароль</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationPassword($password)
    {
        $lenPassword = mb_strlen($password);
        if ($lenPassword > 4 && $lenPassword <= 15) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация номера буровой
     * @param string $drillNumber <p>номер буровой</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationDrillNumber($drillNumber)
    {
        $pattern = "~[0-9]{2,3}[a-zA-Z]~";
        if (preg_match($pattern, $drillNumber) || $drillNumber == '') {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация имени буровой
     * @param string $drillName <p>название буровой</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationDrillName($drillName)
    {
        $lenDrillName = mb_strlen($drillName);
        if ($lenDrillName >= 6 && $lenDrillName <=50) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация координат (градусов)
     * @param string $degrees <p>градусы координат</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationCoordinateDegrees($degrees)
    {
        if (preg_match("~[a-zA-Zа-яА-Я]+~", $degrees)) {
            return false;
        }
        $degrees = intval($degrees);
        if ($degrees >=0 && $degrees <=359) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация координат (минуты)
     * @param string $minutes <p>минуты координат</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationCoordinateMinutes($minutes)
    {
        if (preg_match("~[a-zA-ZА-Яа-я]+~", $minutes)) {
            return false;
        }
        $minutes = intval($minutes);
        if ($minutes >= 0 || $minutes <= 59) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация координат (секунды)
     * @param string $seconds <p>секунды координат</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationCoordinateSeconds($seconds)
    {
        if (preg_match("~[a-zA-Zа-яА-Я]~", $seconds)) {
            return false;
        }
        $seconds = floatval($seconds);
        if ($seconds >=0 || $seconds <= 59.99) {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация дат
     * @param string $date <p>дата в формате дд.мм.гггг</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationDate($date)
    {
        $pattern = "~[0-9]{4}-[0-9]{2}-[0-9]{2}~";
        if (preg_match($pattern, $date) || $date == '') {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация email пользователя
     * @param string $email <p>email пользователя</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    public static function validationEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) || $email == '' ) {
            return true;
        }
        return false;
    }

}
