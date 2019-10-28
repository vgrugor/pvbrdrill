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
        
        //$result = $db->query('SELECT * '
        //        . 'FROM worker ');
        
        $result = $db->query('SELECT '
                . 'worker.id, worker.name, worker.phone_number, worker.email, '
                . 'worker.date_refresh, worker.note, '
                . 'drill.name AS drill_name, '
                . 'position.name AS position_name, '
                . 'vpn_status.name AS vpn_status_name '
                . 'FROM worker ' 
                . 'LEFT JOIN drill '
                . 'ON worker.drill_id = drill.id '
                . 'LEFT JOIN position '
                . 'ON worker.position_id = position.id '
                . 'LEFT JOIN vpn_status '
                . 'ON worker.vpn_status_id = vpn_status.id');
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $workerList[$i]['id'] = $row['id'];
            $workerList[$i]['drill'] = $row['drill_name'];
            $workerList[$i]['position_name'] = $row['position_name'];
            $workerList[$i]['name'] = $row['name'];
            $workerList[$i]['phone_number'] = $row['phone_number'];
            $workerList[$i]['email'] = $row['email'];
            $workerList[$i]['vpn_status_name'] = $row['vpn_status_name'];
            $workerList[$i]['date_refresh'] = self::displayDate($row['date_refresh']);
            $workerList[$i]['note'] = $row['note'];
            $i++;
        }
        
        return $workerList;
        
    }
    
    /**
     * Преобразовывает timestamp int в формат dd.mm.yyyy
     * @param int $timestamp
     * @return string
     */
    private static function displayDate($timestamp) {
        
        $timestamp = intval($timestamp);
        
        if (! $timestamp) {
            return '-';
        }
        
        return date('d.m.Y', $timestamp);
    }
}
