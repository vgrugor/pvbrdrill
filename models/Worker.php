<?php

class Worker {
    
    const SHOW_BY_DEFAULT = 8;  //работников на странице
    
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
    public static function getWorkerList($page) {
        
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
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
                . 'ON worker.vpn_status_id = vpn_status.id '
                . 'LIMIT ' . self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset);
        
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
    
    public static function getTotalWorkers() {
        
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) as count FROM worker');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $row = $result->fetch();
        
        return $row['count'];
        
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
