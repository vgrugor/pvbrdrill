<?php


class Drill {
    
    /**
     * Возвращает информацию о одной буровой по ее id
     * @param int $id
     */
    public static function getDrillById($id) {
        
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * '
                    . 'FROM drill '
                    . 'WHERE id = ' . $id);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $drillItem = $result->fetch();
            
            return $drillItem;
        }
        
    }
    
    /**
     * Возвращает список буровых в виде массива
     */
    public static function getDrillList() {
        
        $db = Db::getConnection();
        
        $drillList = [];
        
        $result = $db->query('SELECT * '
                . 'FROM drill '
                . 'ORDER BY drill_type_id');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $drillList[$i]['id'] = $row['id'];
            $drillList[$i]['number'] = $row['number'];
            $drillList[$i]['drill_type_id'] = $row['drill_type_id'];
            $drillList[$i]['name'] = $row['name'];
            $drillList[$i]['nld'] = $row['nld'];
            $drillList[$i]['nlm'] = $row['nlm'];
            $drillList[$i]['nls'] = $row['nls'];
            $drillList[$i]['eld'] = $row['eld'];
            $drillList[$i]['elm'] = $row['elm'];
            $drillList[$i]['els'] = $row['els'];
            $i++;
        }
        
        return $drillList;
                
    }
}
