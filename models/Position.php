<?php

/**
 * Работа с должностями
 *
 * @author rt.hryhoriev
 */
class Position {
    
    /**
     * Получить список должностей вместе с организациями, отделами, подразделениями
     * @return array <p>массив с информаций о должностях</p>
     */
    public static function getPositionsList($department_id = NULL, $division_id = NULL)
    {
        //если указан и отдел и подразделение, формируем фильтр по отделу 
        if ($department_id && $division_id) {
            $filterDepartment =  'position.department_id = :department_id AND ';
        //если передан только отдел, показать по ид отдела без подразделений
        } elseif ($department_id && !$division_id) {
            $filterDepartment =  'position.department_id = :department_id AND position.division_id = 0 AND ';
        } else {
            $filterDepartment = '';
        }
        
        //если передано подразделение, формируем фильтр по подразделению
        if ($division_id) {
            $filterDivision = 'division.id = :division_id AND ';
        } else {
            $filterDivision = '';
        }
        
        $positions = [];
        
        $db = Db::getConnection();
        
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
                . 'WHERE '
                . $filterDepartment
                . $filterDivision
                . 'position.id > 0 '
                . 'ORDER BY org_name ASC';
        
        $result = $db->prepare($sql);
        
        $filterDepartment ? $result->bindParam(':department_id', $department_id, PDO::PARAM_INT) : '';
        $filterDivision ? $result->bindParam(':division_id', $division_id, PDO::PARAM_INT): '';
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
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
        
        $sql = 'SELECT position.id as position_id, '
                . 'position.name as name, '
                . 'organization.name as organization_name,'
                . 'organization.id as organization_id,'
                . 'department.id as department_id, '
                . 'department.name as department_name, '
                . 'division.name as division_name, '
                . 'division.id as division_id '
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
    
    /**
     * Добавление новой должности
     * @param array $options <p>свойства добавляемой должности</p>
     * @return boolean <p>результат выполнения запроса INSERT</p>
     */
    public static function createPosition($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO position (organization_id, department_id, division_id, name) '
                . 'VALUES (:organization_id, :department_id, :division_id, :name)';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':organization_id', $options['organization_id'], PDO::PARAM_INT);
        $result->bindParam(':department_id', $options['department_id'], PDO::PARAM_INT);
        $result->bindParam(':division_id', $options['division_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Обновление информации о должности
     * @param integer $id <p>id должности, информацию о которой нужно обновить</p>
     * @param array $options <p>свойства должности</p>
     * @return boolean <p>результат выполнения запроса UPDATE</p>
     */
    public static function updatePositionById($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE position SET '
                . 'organization_id = :organization_id, '
                . 'department_id = :department_id, '
                . 'division_id = :division_id, '
                . 'name = :name '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':organization_id', $options['organization_id'], PDO::PARAM_INT);
        $result->bindParam(':department_id', $options['department_id'], PDO::PARAM_INT);
        $result->bindParam(':division_id', $options['division_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
