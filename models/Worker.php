<?php

class Worker {
    
    /**
     * Возвращает информацию о одном работнике в виде массива
     * @param int $id
     */
    public static function getWorkerById($id) {
        
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * '
                    . 'FROM worker '
                    . 'WHERE id = ' . $id);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $workerItem = $result->fetch();
            
            return $workerItem;
        }
    }
    
    /**
     * Возвращает список всех работиков в виде массива
     */
    public static function getWorkerList() {
        
        $db = Db::getConnection();
        
        $workerList = [];
        
        $result = $db->query('SELECT * '
                . 'FROM worker ');
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $workerList[$i]['id'] = $row['id'];
            $workerList[$i]['drill_id'] = $row['drill_id'];
            $workerList[$i]['position_id'] = $row['position_id'];
            $workerList[$i]['name'] = $row['name'];
            $workerList[$i]['phone_number'] = $row['phone_number'];
            $workerList[$i]['email'] = $row['email'];
            $workerList[$i]['vpn_status_id'] = $row['vpn_status_id'];
            $workerList[$i]['date_refresh'] = $row['date_refresh'];
            $workerList[$i]['note'] = $row['note'];
            $i++;
        }
        
        return $workerList;
        
    }
}
