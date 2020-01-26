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
    
    /**
     * Страница удаления статуса vpn
     * @param int $id <p>id статуса vpn, который необходимо удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $vpnStatus = VpnStatus::getVpnStatusById($id);
        
        if (isset($_POST['submit'])) {
            VpnStatus::deleteVpnStatusById($id);
            
            header('Location: /admin/vpnstatus');
        }
        
        require_once ROOT . '/views/admin_vpnstatus/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания нового статуса для vpn
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        if (isset($_POST['submit'])) {
            $errors = false;
            
            $options['name'] = $_POST['name'];
            
            if (!Validator::validationVpnStatusName($options['name'])) {
                $errors[] = 'Статус для VPN має бути довшим 4-ох символів.';
                echo Validator::validationVpnStatusName($options['name']);
            }
            
            if ($errors == false) {
                VpnStatus::createVpnStatus($options);
                
                header('Location: /admin/vpnstatus');
            }
        }
        
        require_once ROOT . '/views/admin_vpnstatus/create.php';
        
        return true;
    }
}
