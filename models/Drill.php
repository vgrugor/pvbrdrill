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
     * Возвращает всю информацию о буровых с таблицы drill
     * @return array
     */
    public static function getInfoAboutDrills() {
        
        $db = Db::getConnection();
        
        $drillList = [];
        
        $result = $db->query('SELECT '
                . 'drill.id, number, drill_type.name as type_name, drill.name, '
                . 'nld, nlm, nls, eld, elm, els, coordinate_stage, address, phone_number,  '
                . 'date_building, date_drilling, date_demount, date_transfer, date_refresh, '
                . 'email, note '
                . 'FROM drill '
                . 'LEFT JOIN drill_type '
                . 'ON drill.drill_type_id = drill_type.id '
                . 'ORDER BY type_name');
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $drillList[$i]['id'] = $row['id'];
            $drillList[$i]['number'] = $row['number'];
            $drillList[$i]['type_name'] = $row['type_name'];
            $drillList[$i]['name'] = $row['name'];
            $drillList[$i]['nld'] = $row['nld'];
            $drillList[$i]['nlm'] = $row['nlm'];
            $drillList[$i]['nls'] = $row['nls'];
            $drillList[$i]['eld'] = $row['eld'];
            $drillList[$i]['elm'] = $row['elm'];
            $drillList[$i]['els'] = $row['els'];
            $drillList[$i]['coordinate_stage'] = $row['coordinate_stage'];
            $drillList[$i]['address'] = $row['address'];
            $drillList[$i]['phone_number'] = $row['phone_number'];
            $drillList[$i]['date_building'] = $row['date_building'];
            $drillList[$i]['date_drilling'] = $row['date_drilling'];
            $drillList[$i]['date_demount'] = $row['date_demount'];
            $drillList[$i]['date_transfer'] = $row['date_transfer'];
            $drillList[$i]['date_refresh'] = $row['date_refresh'];
            $drillList[$i]['email'] = $row['email'];
            $drillList[$i]['note'] = $row['note'];
            $i++;
        }
        
        return $drillList;
                
    }
}
