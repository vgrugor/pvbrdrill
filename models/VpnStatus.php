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
    
    /**
     * Получение информации о статусе VPN по его id
     * @param int $id <p>id статуса vpn, информацию о котором нужно получить</p>
     * @return array <p>массив с информацией о статусе vpn</p>
     */
    public static function getVpnStatusById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name FROM vpn_status WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }
    
    /**
     * Удаление статуса VPN по его id
     * @param int $id <p>id статуса VPN, который следует удалить</p>
     * @return boolean
     */
    public static function deleteVpnStatusById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM vpn_status WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
