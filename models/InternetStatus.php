<?php

/**
 * Description of InternetStatus
 *
 * @author Zver
 */
class InternetStatus {
    
    /**
     * Получение списка статусов для интернета на буровых
     * @return array
     */
    public static function getInternetStatusesList()
    {
        $db = Db::getConnection();
        
        $internetStatuses = [];
        
        $sql = 'SELECT id, name FROM internet_status ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $internetStatuses[$i]['id'] = $row['id'];
            $internetStatuses[$i]['name'] = $row['name'];
            $i++;
        }
        return $internetStatuses;
    }
}
