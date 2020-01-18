<?php

/**
 * Типы буровых
 *
 * @author Zver
 */
class DrillType {
    
    /**
     * Получение всех типов буровых
     * @return array <p>Массив с типами буровых</p>
     */
    public static function getDrillTypesList()
    {
        $db = Db::getConnection();
        
        $drillTypes = [];
        
        $sql = 'SELECT id, name FROM drill_type';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $drillTypes[$i]['id'] = $row['id'];
            $drillTypes[$i]['name'] = $row['name'];
            $i++;
        }
        return $drillTypes;
    }
}
