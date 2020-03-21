<?php

/**
 * Description of InternetStatus
 *
 * @author Zver
 */
class InternetStatus {
    
    /**
     * Получение списка статусов для интернета на буровых
     * @return array
     */
    public static function getInternetStatusesList()
    {
        $db = Db::getConnection();
        
        $internetStatuses = [];
        
        $sql = 'SELECT id, name FROM internet_status ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i=0;
        while ($row = $result->fetch()) {
            $internetStatuses[$i]['id'] = $row['id'];
            $internetStatuses[$i]['name'] = $row['name'];
            $i++;
        }
        return $internetStatuses;
    }
    
    /**
     * Получение информации о статусе интернета по его id
     * @param int $id <p>id статуса интернета, который необходимо удалить</p>
     * @return array <p>массив с информацией о статусе интернета</p>
     */
    public static function getInternetStatusById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name FROM internet_status WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }
    
    /**
     * Удаление статуса интернета по его id
     * @param int $id <p>id статуса интернета, который нужно удалить</p>
     * @return boolean <p>результат выполнения запроса DELETE</p>
     */
    public static function deleteInternetStatusById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM internet_status WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    /**
     * Создание нового статуса интернета
     * @param array $options <p>свойства нового статуса интернета</p>
     * @return boolean <p>результат выполнения запроса INSERT</p>
     */
    public static function createInternetStatus($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO internet_status (name) VALUES (:name)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Обновление информации о статусе интернета по его id
     * @param integer $id <p>id статуса, информацию о котором нужно обновить</p>
     * @param array $options <p>массив со свойствами редактируемого статуса</p>
     * @return boolean <p></p>
     */
    public static function updateInternetStatusById($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE internet_status SET '
                . 'name = :name '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        
        return $result->execute();
    }
}
