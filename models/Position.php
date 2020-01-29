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
    
    /**
     * Получение должности по ее id
     * @param int $id <p>id должности, информацию о которой необходимо получить</p>
     * @return array <p>массив с информацией о должности</p>
     */
    public static function getPositionById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT position.id as pos_id, '
                . 'position.name as pos_name, '
                . 'organization.name as org_name,'
                . 'department.name as dep_name, '
                . 'division.name as div_name '
                . 'FROM position '
                . 'LEFT JOIN organization '
                . 'ON position.organization_id = organization.id '
                . 'LEFT JOIN department '
                . 'ON position.department_id = department.id '
                . 'LEFT JOIN division '
                . 'ON position.division_id = division.id '
                . 'WHERE position.id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }
    
    /**
     * Удаление должности по ее id
     * @param int $id <p>id должности, которую необходимо удалить</p>
     * @return bool <p>результат выполнения запроса DELETE</p>
     */
    public static function deletePositionById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM position WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
