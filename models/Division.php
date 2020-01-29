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
    
    /**
     * Получение информации о подразделении по его id
     * @param int $id <p>id подразделения, информацию о котором нужно получить</p>
     * @return array <p>Массив с информацией о подразделении</p>
     */
    public static function getDivisionById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, name, note FROM division ORDER BY id ASC';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
    }

    /**
     * Удаление подразделения по его id
     * #param int <p>id подразделения, которое нужно удалить</p>
     * @return bool <p>Результат выполнения запроса DELETE</p>
     */
    public static function deleteDivisionById($id)
    {
        $db = Db::getConnection();
        
        $sql= 'DELETE FROM division WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        return $result->execute();
    }
}
