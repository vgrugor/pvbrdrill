<?php

/**
 * Типы буровых
 *
 * @author Zver
 */
class DrillType {
    
    /**
     * Получение всех типов буровых
     * @return array <p>Массив с типами буровых</p>
     */
    public static function getDrillTypesList()
    {
        $db = Db::getConnection();
        
        $drillTypes = [];
        
        $sql = 'SELECT id, name FROM drill_type ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $drillTypes[$i]['id'] = $row['id'];
            $drillTypes[$i]['name'] = $row['name'];
            $i++;
        }
        return $drillTypes;
    }
    
    /**
     * Получение информации о типе буровой по его id
     * @param int $id <p>id типа буровой, информацию о котором нужно получить</p>
     * @return array <p>массив с информацией о типе буровой</p>
     */
    public static function getDrillTypeById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name FROM drill_type WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }
    
    /**
     * Удаление типа буровой по ее id
     * @param int $id <p>id типа буровой, который следует удалить</p>
     * @return boolean <p>результат выполнения запроса DELETE</p>
     */
    public static function deleteDrillTypeById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM drill_type WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}