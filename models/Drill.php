<?php


class Drill {
    
    /**
     * Возвращает информацию о одной буровой по ее id
     * @param int $id
     */
    public static function getDrillById($id) {
        
    }
    
    /**
     * Возвращает список буровых в виде массива
     */
    public static function getDrillList() {
        
        $host = 'localhost';
        $dbname = 'pvbr_test';
        $user = 'root';
        $password = '';
        
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        
        $drillList = [];
        
        $result = $db->query('SELECT * '
                . 'FROM drill');
        
        $i = 0;
        while ($row = $result->fetch()) {
            $drillList[$i]['id'] = $row['id'];
            $drillList[$i]['number'] = $row['number'];
            $drillList[$i]['drill_type_id'] = $row['drill_type_id'];
            $drillList[$i]['name'] = $row['name'];
            $drillList[$i]['nld'] = $row['nld'];
            $drillList[$i]['nlm'] = $row['nlm'];
            $drillList[$i]['nls'] = $row['nls'];
            $i++;
        }
        
        return $drillList;
                
    }
}
