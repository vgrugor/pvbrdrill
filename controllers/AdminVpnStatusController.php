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
            
            if (!$this->validator->make($options['name'], ['string', 4, 50])) {
                $errors[] = 'Статус для VPN має бути в межах від 4-ох до 50 символів.';
            }
            
            if ($errors == false) {
                VpnStatus::createVpnStatus($options);
                
                header('Location: /admin/vpnstatus');
            }
        }
        
        require_once ROOT . '/views/admin_vpnstatus/create.php';
        
        return true;
    }
    
    
    /**
     * Редактирование статуса VPN 
     * @param integer $id <p>id статуса для обновления</p>
     * @return boolean
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $vpnStatus = VpnStatus::getVpnStatusById($id);
        
        if (isset($_POST['submit'])) {
            $errors = false;
            
            $vpnStatus['name'] = $_POST['name'];
            
            if (!$this->validator->make($vpnStatus['name'], ['string', 4, 50])) {
                $errors[] = 'Статус для VPN має бути в межах від 4-ох до 50 символів.';
            }
            
            if ($errors == false) {
                VpnStatus::updateVpnStatusById($id, $vpnStatus);
                
                header('Location: /admin/vpnstatus');
            }
        }
        require_once ROOT . '/views/admin_vpnstatus/update.php';
        
        return true;
    }
}
