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
        if (mb_strlen($vpnName) > 4) {
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
        if (mb_strlen($internetStatusName) > 4) {
            return true;
        }
        return false;
    }
}
