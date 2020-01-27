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
        if ($lenVpn > 4 && $lenVpn < 51) {
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
        if ($lenInternetStatus > 4 && $lenInternetStatus < 51) {
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
        if ($lenDrillType > 4 && $lenDrillType < 11) {
            return true;
        }
        return false;
    }
}
