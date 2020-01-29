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
    public static function validationPhoneNumber($phoneNumber)
    {
        $pattern = "~^\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$~";
        if (preg_match($pattern, $phoneNumber) || $phoneNumber == "") {
            return true;
        }
        return false;
    }
}
