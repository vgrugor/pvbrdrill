<?php

class Worker extends ModelBase {
    
    const SHOW_BY_DEFAULT = 10;  //работников на странице
    
    /**
     * Возвращает информацию о одном работнике в виде массива
     * @param int $id Ид сотрудника
     * @return array $workerItem Массив с информацией о одном работнике
     */
    public static function getWorkerById($id) {
              
        $db = Db::getConnection();
            
        $sql = 'SELECT drill.id as drill_id, '
                . 'worker.name as name, '
                . 'drill.name as drill, '
                . 'worker.position_id as position_id, '
                . 'position.name as position, '
                . 'position.division_id as division_id, '
                . 'position.department_id as department_id, '
                . 'position.organization_id as organization_id, '
                . 'vpn_status.id as vpn_status_id, '
                . 'vpn_status.name as vpn_status, '
                . 'worker.phone_number as phone_number, '
                . 'worker.email, worker.note as note, '
                . 'worker.account_ad as account_ad, '
                . 'worker.date_refresh as worker_refresh '
                . 'FROM worker '
                . 'LEFT JOIN drill '
                . 'ON worker.drill_id = drill.id '
                . 'LEFT JOIN position '
                . 'ON worker.position_id = position.id '
                . 'LEFT JOIN vpn_status '
                . 'ON worker.vpn_status_id = vpn_status.id '
                . 'WHERE worker.id = :id';
            
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
            
        $result->setFetchMode(PDO::FETCH_ASSOC);
            
        $result->execute();
            
        $workerItem = $result->fetch();
            
        return $workerItem;
    }
    
    /**
     * Получить работников определенной буровой
     * @param int $drillId Ид необходимой буровой
     * @return array $workers Все работники определенной буровой
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
                $workers[$i]['date_refresh'] = $row['date_refresh'];
                $i++;
            }
            
            return $workers;
        }
    }

    /**
     * Возвращает список всех работиков в виде массива
     * @param int $page Номер страницы в списке сотрудников
     * @return array $workerList Список всех работников (постранично)
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
    
    /**
     * Общее количество работников
     * @return int $row['count'] Количество работников
     */
    public static function getTotalWorkers() {
        
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) as count FROM worker');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $row = $result->fetch();
        
        return $row['count'];
        
    }

    /**
    * Преобразовывает timestamp int в формат dd.mm.yyyy
    * @param int $timestamp Таймштамп времени
    * @return string $date Дата в формате dd.mm.yyyy
    */
    private static function displayDate($timestamp) {
        
        $timestamp = intval($timestamp);
        
        if (! $timestamp) {
            return '-';
        }
        
        $date = date('d.m.Y', $timestamp);
        
        return $date;
    }
    
    /**
     * Транслитерация ФИО сотрудника
     * @param str $workerName ФИО сотрудника
     * @return String|Bool $translitWorkerName. Если удалось преобразовать - 
     * Имя.Фамилия латиницей (string), если нет - false
     */
    public static function getTranslitName($workerName)
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
        
        /*
        //преобразуем строку в массив
        $workerNameArray = explode(' ', $workerName);
        
        //если в массиве есть хотя бы имя и фамилия, разделенный пробелом
        if (count($workerNameArray) > 1) {
            //правильная последовательность имя фамилия
            $nameForTransliterate = $workerNameArray[1] . ' ' . $workerNameArray[0];
            
            $result = strtr($nameForTransliterate, $converter);
            
            return $result;
        }
        */
        //преобразуем строку в массив
        $dividedWorkerNameArray = explode(' ', $workerName);
        
        //если в массиве есть хотя бы имя и фамилия, разделенный пробелом
        if (count($dividedWorkerNameArray) > 1) {
            list($lastName, $firstName) = $dividedWorkerNameArray;
            
            //правильная последовательность: имя фамилия
            $workerNameForTranslit = $firstName . ' ' . $lastName;
        
            $translitWorkerName = strtr($workerNameForTranslit, $converter);
            
            return $translitWorkerName;
        }
        
        return false;
    }
    
    /**
     * Удаление работника по его id
     * @param int $id <p>id работника, которого нужно удалить</p>
     * @return bool <p>результат выполнения запроса DELETE</p>
     */
    public static function deleteWorkerById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM worker WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    /**
     * Добавление нового сотрудника
     * @param type $options <p>свойства сотрудника</p>
     * @return type <p>результат выполнения запроса INSERT</p>
     */
    public static function createWorker($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO worker (drill_id, position_id, name, account_ad, '
                . 'phone_number, email, vpn_status_id, date_refresh, note) '
                . 'VALUES '
                . '(:drill_id, :position_id, :name, :account_ad, :phone_number, '
                . ':email, :vpn_status_id, :date_refresh, :note)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':drill_id', $options['drill_id'], PDO::PARAM_INT);
        $result->bindParam(':position_id', $options['position_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':account_ad', $options['account_ad'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':vpn_status_id', $options['vpn_status_id'], PDO::PARAM_STR);
        $result->bindParam(':date_refresh', $options['date_refresh'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Обновление информации о работнике по его id
     * @param integer $id <p>id работника, информацию о котором нужно обновить</p>
     * @param array $options <p>массив со свойствами работника</p>
     * @return boolean <p>результат выполнения запроса UPDATE</p>
     */
    public static function updateWorkerById($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE worker SET '
                . 'drill_id = :drill_id, '
                . 'position_id = :position_id, '
                . 'name = :name, '
                . 'account_ad = :account_ad, '
                . 'phone_number = :phone_number, '
                . 'email = :email, '
                . 'vpn_status_id = :vpn_status_id, '
                . 'date_refresh = :date_refresh, '
                . 'note = :note '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':drill_id', $options['drill_id'], PDO::PARAM_INT);
        $result->bindParam(':position_id', $options['position_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':account_ad', $options['account_ad'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':vpn_status_id', $options['vpn_status_id'], PDO::PARAM_STR);
        $result->bindParam(':date_refresh', $options['date_refresh'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}
