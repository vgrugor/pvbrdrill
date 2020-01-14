<?php

/**
 * Управление подразделениями
 *
 * @author rt.hryhoriev
 */
class Division {
    
    /**
     * Возвращает информацию о подразделениях
     * @return array <p>Массив с информацией о подразделениях</p>
     */
    public static function getDivisionsList()
    {
        $db = Db::getConnection();
        
        $divisions = [];
        
        $sql = 'SELECT division.id as div_id, '
                . 'division.name as div_name, '
                . 'division.note as div_note, '
                . 'department.name as dep_name '
                . 'FROM division '
                . 'LEFT JOIN department '
                . 'ON '
                . 'division.department_id = department.id '
                . 'ORDER BY department_id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $divisions[$i]['id'] = $row['div_id'];
            $divisions[$i]['department'] = $row['dep_name'];
            $divisions[$i]['name'] = $row['div_name'];
            $divisions[$i]['note'] = $row['div_note'];
            $i++;
        }
        return $divisions;
    }
}
