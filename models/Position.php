<?php

/**
 * Работа с должностями
 *
 * @author rt.hryhoriev
 */
class Position {
    
    /**
     * 
     * @return array <p>массив с информаций </p>
     */
    public static function getPositionsList()
    {
        $db = Db::getConnection();
        
        $positions = [];
        
        $sql = 'SELECT position.id as pos_id, '
                . 'position.name as pos_name, '
                . 'division.name as div_name, '
                . 'department.name as dep_name, '
                . 'organization.name as org_name '
                . 'FROM position '
                . 'LEFT JOIN organization '
                . 'ON organization.id = position.organization_id '
                . 'LEFT JOIN department '
                . 'ON department.id = position.department_id '
                . 'LEFT JOIN division '
                . 'ON division.id = position.division_id '
                . 'ORDER BY org_name ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $positions[$i]['id'] = $row['pos_id'];
            $positions[$i]['organization'] = $row['org_name'];
            $positions[$i]['department'] = $row['dep_name'];
            $positions[$i]['division'] = $row['div_name'];
            $positions[$i]['name'] = $row['pos_name'];
            $i++;
        }
        return $positions;
    }
}
