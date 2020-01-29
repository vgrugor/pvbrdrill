<?php

/**
 * Description of Department
 *
 * @author Zver
 */
class Department {
    
    /**
     * Возвращает список всех отделов и информацию о них
     * @return array <p>Массив с информацией о отделах</p>
     */
    public static function getDepartmentsList()
    {
        $db = Db::getConnection();
        
        $departments = [];
        
        $sql = 'SELECT department.id as dep_id, '
                . 'department.name as dep_name, '
                . 'department.note as dep_note, '
                . 'organization.name as org_name '
                . 'FROM department '
                . 'LEFT JOIN organization '
                . 'ON department.organization_id = organization.id '
                . 'ORDER BY organization_id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
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
        
        $sql = 'SELECT id, name, phone_number, note '
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
}
