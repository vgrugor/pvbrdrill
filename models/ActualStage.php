<?php

/**
 * Description of ActualStage
 *
 * @author Zver
 */
class ActualStage {
    
    /**
     * Получение информации о фактической стадии бурения по ее id
     * @param integer $id <p>id фактической стадии бурения, информацию о которой нужно получить</p>
     * @return array <p>массив с информацией о фактической стадии бурения</p>
     */
    public static function getActualStageById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name FROM actual_stage WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }
    
    /**
     * Получить список фактических стадий бурения
     * @return array <p>Массив с ифнформацией о всех фактических стадиях бурения</p>
     */
    public static function getActualStageList()
    {
        $db = Db::getConnection();
        
        $actualStageList = [];
        
        $sql = 'SELECT id, name FROM actual_stage';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $actualStageList[$i]['id'] = $row['id'];
            $actualStageList[$i]['name'] = $row['name'];
            $i++;
        }
        return $actualStageList;
    }
    
    /**
     * Создание фактической стадии бурения
     * @param array $options <p>массив со свойствами новой фактической стадии бурения</p>
     * @return boolean <p>результат выполнения запроса INSERT</p>
     */
    public static function createActuslStage($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO actual_stage (name) VALUES (:name)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Изменение информации о фактической стадии бурения
     * @param integer $id <p>id фактической стадии, которую нужно изменить</p>
     * @param array $options <p>обновленная информация о фактической стадии</p>
     * @return boolean <p>результат выполнения запроса UPDATE</p>
     */
    public static function updateActuslStage($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE actual_stage SET name = :name WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Удаление фактической стадии бурения
     * @param integer $id <p>id фактической стадии бурения, которую нужно удалить</p>
     * @return boolean  <p>результат выполнения запроса DELETE</p>
     */
    public static function deleteActualStageById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM actual_stage WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
