<?php

/**
 * Организации
 *
 * @author Zver
 */
class Organization {
    
    /**
     * Возвращает информацию о всех организациях
     * @return array <p>массив с информацией о организациях</p>
     */
    public static function getOrganizationsList()
    {
        $db = Db::getConnection();
        
        $organizations = [];
        
        $sql = 'SELECT id, name, address, note FROM organization ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $organizations[$i]['id'] = $row['id'];
            $organizations[$i]['name'] = $row['name'];
            $organizations[$i]['address'] = $row['address'];
            $organizations[$i]['note'] = $row['note'];
            $i++;
        }
        return $organizations;
    }
    
    /**
     * Получение информации о организации по ее id
     * @param int $id <p>id необходимой организации</p>
     * @return array <p>массив с информацией о организации</p>
     */
    public static function getOrganizationById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT name, address, note FROM organization WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }

    /**
     * Удаление организации по ее id
     * @param int $id <p>id организации для удаления</p>
     * @return bool <p>Результат выполнения запроса на удаление организации</p>
     */
    public static function deleteOrganizationById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM organization WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
