<?php

/**
 * Description of Department
 *
 * @author Zver
 */
class Department {
    
    /**
     * Возвращает список всех отделов и информацию о них
     * @param integer $id <p>необязательный. id организации для выборки отделов</p>
     * @return array <p>Массив с информацией о отделах</p>
     */
    public static function getDepartmentsList($id = 0)
    {
        $db = Db::getConnection();
        
        $departments = [];
        
        $sql = 'SELECT department.id as dep_id, '
                . 'department.name as dep_name, '
                . 'department.note as dep_note, '
                . 'organization.name as org_name '
                . 'FROM department '
                . 'LEFT JOIN organization '
                . 'ON department.organization_id = organization.id ';
        
        if ($id) {
            $sql .= 'WHERE department.organization_id = :id ';
        }
                
        $sql .= 'ORDER BY org_name ASC';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        $i=0;
        while ($row = $result->fetch()) {
            $departments[$i]['id'] = $row['dep_id'];
            $departments[$i]['organization'] = $row['org_name'];
            $departments[$i]['name'] = $row['dep_name'];
            $departments[$i]['note'] = $row['dep_note'];
            $i++;
        }
        return $departments;
    }
    
    /**
     * Получить информацию об отделе по его id
     * @param int $id <p>id отдела, информацию о котором нужно получить</p>
     * @return array <p>массив с информацией об отделе</p>
     */
    public static function getDepartmentById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name, organization_id, phone_number, note '
                . 'FROM department '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }

        /**
     * Удалить отдел по его id
     * @param int $id <p>id отдела, который нужно удалить</p>
     * @return bool
     */
    public static function deleteDepartmentById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM department WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    /**
     * Добавление нового отдела
     * @param array $options <p>свойства нового отдела</p>
     * @return boolean <p>результат выполнения запроса INSERT</p>
     */
    public static function createDepartment($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO department (organization_id, name, phone_number, note) '
                . 'VALUES (:organization_id, :name, :phone_number, :note)';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':organization_id', $options['organization_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Обновление информации о отделе по его id
     * @param integer $id <p>id отдела, информацию о котором нужно изменить</p>
     * @param array $options <p>массив с информацией о отделе</p>
     * @return boolean <p>результат выполнения запроса UPDATE</p>
     */
    public static function updateDepartmentById($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE department SET '
                . 'organization_id = :organization_id, '
                . 'name = :name, '
                . 'phone_number = :phone_number, '
                . 'note = :note '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':organization_id', $options['organization_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        $result->bindParam(':id', $options['id'], PDO::PARAM_INT);
        
        return $result->execute();
    }
}
