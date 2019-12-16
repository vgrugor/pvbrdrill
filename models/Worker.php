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
            
            $result = $db->query('SELECT drill.id as drill_id, '
                    . 'worker.name as worker_name, '
                    . 'drill.name as drill_name, '
                    . 'position.name as position_name,'
                    . 'vpn_status.name as vpn_status_name, '
                    . 'worker.phone_number as worker_phone_number, '
                    . 'worker.email, worker.note as worker_note, '
                    . 'vpn_status.name as vpn_name, '
                    . 'worker.date_refresh as worker_refresh '
                    . 'FROM worker '
                    . 'LEFT JOIN drill '
                    . 'ON worker.drill_id = drill.id '
                    . 'LEFT JOIN position '
                    . 'ON worker.position_id = position.id '
                    . 'LEFT JOIN vpn_status '
                    . 'ON worker.vpn_status_id = vpn_status.id '
                    . 'WHERE worker.id = ' . $id);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $workerItem = $result->fetch();
            $workerItem['worker_refresh'] = Worker::displayDate($workerItem['worker_refresh']);
            
            return $workerItem;
        }
    }
    
    /**
     * Получить работников буровой
     * @param int $drillId
     */
    public static function getWorkersByDrill($drillId)
    {
        $workers = [];
        
        $drillId = intval($drillId);
        
        if ($drillId) {
            $db = Db::getConnection();
            
            $sql = 'SELECT position.name as position_name, worker.name as name, '
                    . 'worker.phone_number, worker.email, worker.date_refresh, '
                    . 'worker.id as worker_id '
                    . 'FROM worker '
                    . 'LEFT JOIN position '
                    . 'ON worker.position_id = position.id '
                    . 'WHERE drill_id = :drillId '
                    . 'ORDER BY worker.date_refresh DESC';
            
            $result = $db->prepare($sql);
            $result->bindParam(':drillId', $drillId, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            $i = 0;
            while ($row = $result->fetch()) {
                $workers[$i]['id'] = $row['worker_id'];
                $workers[$i]['name'] = $row['name'];
                $workers[$i]['position_name'] = $row['position_name'];
                $workers[$i]['phone_number'] = $row['phone_number'];
                $workers[$i]['email'] = $row['email'];
                $workers[$i]['date_refresh'] = self::displayDate($row['date_refresh']);
                $i++;
            }
            
            return $workers;
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
    
    /**
     * Транслитерация ФИО сотрудника
     * @param str $workerName
     * @return type
     */
    public static function transliterate($workerName)
    {
        $converter = [
            "а" => "a",             "б" => "b",             "в" => "v", 
            "г" => "h",             "ґ" => "g",             "д" => "d", 
            "е" => "e",             "є" => "ie",            "ё" => "jo", 
            "ж" => "zh",            "з" => "z",             "и" => "y", 
            "і" => "i",             "ї" => "i",             "й" => "i", 
            "к" => "k",             "л" => "l",             "м" => "m", 
            "н" => "n",             "о" => "o",             "п" => "p", 
            "р" => "r",             "с" => "s",             "т" => "t", 
            "у" => "u",             "ф" => "f",             "х" => "kh", 
            "ц" => "ts",            "ч" => "ch",            "ш" => "sh", 
            "щ" => "shch",          "ъ" => "",              "ы" => "y", 
            "ь" => "",              "э" => "e",             "ю" => "iu", 
            "я" => "ia",            "і" => "i",             "ї" => "i", 
            "А" => "A",             "Б" => "B",             "В" => "V", 
            "Г" => "H",             "Ґ" => "G",             "Д" => "D", 
            "Е" => "E",             "Ё" => "Jo",            "Ж" => "Zh", 
            "З" => "Z",             "И" => "Y",             "Й" => "Y", 
            "К" => "K",             "Л" => "L",             "М" => "M", 
            "Н" => "N",             "О" => "O",             "П" => "P", 
            "Р" => "R",             "С" => "S",             "Т" => "T", 
            "У" => "U",             "Ф" => "F",             "Х" => "Kh", 
            "Ц" => "Ts",            "Ч" => "Ch",            "Ш" => "Sh", 
            "Щ" => "Shch",          "Ъ" => "",              "Ы" => "Y", 
            "Ь" => "",              "Э" => "E",             "Ю" => "Yu", 
            "Я" => "Ya",            "’" => "",              "І" => "I", 
            "Ї" => "Yi",            "Є" => "Ye",            "'" => "", 
            " " => ".",             "." => "."
        ];
        
        $nameForTranslit = self::getNameForTransliterate($workerName);
        
        $result = strtr($nameForTranslit, $converter);
        
        return $result;
    }
    
    /**
     * Преобразование Фамилия Имя в Имя Фамилия для транслитерации (учетной записи)
     * @param str $workerName
     * @return boolean|string
     */
    public static function getNameForTransliterate($workerName)
    {
        $workerNameArray = explode(' ', $workerName);
        
        if (count($workerNameArray) > 1) {
            $nameForTransliterate = $workerNameArray[1] . ' ' . $workerNameArray[0];
            return $nameForTransliterate;
        }
        return false;
    }
}
