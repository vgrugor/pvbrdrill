<?php

/**
 * Админка статусов VPN
 *
 * @author Zver
 */
class AdminVpnStatusController extends AdminBase {
    
    /**
     * Страница админки статусов для vpn
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $vpnStatuses = VpnStatus::getVpnStatusesList();
        
        require_once ROOT . '/views/admin_vpnstatus/index.php';
        
        return true;
    }
}
