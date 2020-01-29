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
}
