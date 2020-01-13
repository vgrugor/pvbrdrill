<?php

/**
 * Организации
 *
 * @author Zver
 */
class Organization {
    
    /**
     * Возвращает информацию о всех организациях
     * @return array <p>массив с информацией о организациях</p>
     */
    public static function getOrganizationsList()
    {
        $db = Db::getConnection();
        
        $organizations = [];
        
        $sql = 'SELECT id, name, address, note FROM organization ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $organizations[$i]['id'] = $row['id'];
            $organizations[$i]['name'] = $row['name'];
            $organizations[$i]['address'] = $row['address'];
            $organizations[$i]['note'] = $row['note'];
            $i++;
        }
        return $organizations;
    }
}
