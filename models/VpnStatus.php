<?php

/**
 * Статусы для VPN
 *
 * @author Zver
 */
class VpnStatus {
    
    /**
     * Получить список статусов для VPN
     * @return array <p>массив со списком статусов vpn</p>
     */
    public static function getVpnStatusesList()
    {
        $db = Db::getConnection();
        
        $vpnStatuses = [];
        
        $sql = 'SELECT id, name FROM vpn_status ORDER BY id ASC';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $vpnStatuses[$i]['id'] = $row['id'];
            $vpnStatuses[$i]['name'] = $row['name'];
            $i++;
        }
        return $vpnStatuses;
    }
}
