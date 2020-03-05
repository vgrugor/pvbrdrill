<?php


class Drill extends ModelBase {
    
    /**
     * Возвращает информацию о одной буровой по ее id
     * @param int $id
     */
    public static function getDrillById($id) {
        
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT '
                . 'drill.id, number, drill_type.name as type, drill_type.id as drill_type_id, '
                . 'drill.name, '
                . 'nld, nlm, nls, eld, elm, els, coordinate_stage, address, phone_number,  '
                . 'date_building, date_drilling, date_demount, date_transfer, date_refresh, '
                . 'email, note '
                . 'FROM drill '
                . 'LEFT JOIN drill_type '
                . 'ON drill.drill_type_id = drill_type.id '
                . 'WHERE drill.id = ' . $id);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $drillItem = $result->fetch();
            
            //добавляем в массив удобный вывод данных
            $drillItem['gps'] = self::convertCoordinateGeoToGPS($drillItem['nld'], $drillItem['nlm'], $drillItem['nls'], $drillItem['eld'], $drillItem['elm'], $drillItem['els']);
            $drillItem['geo'] = self::convertGeoCoordinateToString($drillItem['nld'], $drillItem['nlm'], $drillItem['nls'], $drillItem['eld'], $drillItem['elm'], $drillItem['els']);
            $drillItem['coordinate_stage'] = self::getStepOfObtainingCoordinates($drillItem['coordinate_stage']);
            
            return $drillItem;
        }
    }
    
    /**
     * Возвращает всю информацию о буровых с таблицы drill
     * @return array
     */
    public static function getInfoAboutDrills() {
        
        $db = Db::getConnection();
        
        $drillList = [];
        
        $result = $db->query('SELECT '
                . 'drill.id, number, drill_type.name as type_name, drill.name, '
                . 'nld, nlm, nls, eld, elm, els, coordinate_stage, address, phone_number,  '
                . 'date_building, date_drilling, date_demount, date_transfer, date_refresh, '
                . 'email, note '
                . 'FROM drill '
                . 'LEFT JOIN drill_type '
                . 'ON drill.drill_type_id = drill_type.id '
                . 'ORDER BY type_name');
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $drillList[$i]['id'] = $row['id'];
            $drillList[$i]['number'] = $row['number'];
            $drillList[$i]['type_name'] = $row['type_name'];
            $drillList[$i]['name'] = $row['name'];
            $drillList[$i]['geo'] = self::convertGeoCoordinateToString($row['nld'], $row['nlm'], $row['nls'], $row['eld'], $row['elm'], $row['els']);
            $drillList[$i]['gps'] = self::convertCoordinateGeoToGPS($row['nld'], $row['nlm'], $row['nls'], $row['eld'], $row['elm'], $row['els']);
            $drillList[$i]['coordinate_stage'] = self::getStepOfObtainingCoordinates($row['coordinate_stage']);
            $drillList[$i]['address'] = $row['address'];
            $drillList[$i]['phone_number'] = $row['phone_number'];
            $drillList[$i]['date_building'] = $row['date_building'];
            $drillList[$i]['date_drilling'] = $row['date_drilling'];
            $drillList[$i]['date_demount'] = $row['date_demount'];
            $drillList[$i]['date_transfer'] = $row['date_transfer'];
            $drillList[$i]['date_refresh'] = $row['date_refresh'];
            $drillList[$i]['stage'] = self::getStageDrilling($row['date_building'], $row['date_drilling'], $row['date_demount'], $row['date_transfer']);
            $drillList[$i]['email'] = $row['email'];
            $drillList[$i]['note'] = $row['note'];
            $i++;
        }
        
        return $drillList;
                
    }
    
    /**
     * Преобразует геолокацию в GPS-координаты
     * @param int $nDegress - градусы северной долготы
     * @param int $nMinutes - минуты северной долготы
     * @param int $nSeconds - секунды северной долготы
     * @param int $eDegress - градусы восточной широты
     * @param int $eMinutes - минуты восточной широты
     * @param int $eSeconds - секунды восточной широты
     * @return str
     */
    public static function convertCoordinateGeoToGPS($nDegress, $nMinutes, $nSeconds, $eDegress, $eMinutes, $eSeconds) {
        
        if (($nDegress + $eDegress) == 0) {
            return '-';
        }
        
        $nGps = $nDegress + ($nMinutes / 60) + ($nSeconds / 3600);
        $eGps = $eDegress + ($eMinutes / 60) + ($eSeconds / 3600);
        
        $nGps = round($nGps, 6);
        $eGps = round($eGps, 6);
        
        return $nGps . ', ' . $eGps;
    }
    
    /**
     * Возвращает Geo-координаты в виде строки
     * @param int $nDegress - градусы северной долготы
     * @param int $nMinutes - минуты северной долготы
     * @param int $nSeconds - секунды северной долготы
     * @param int $eDegress - градусы восточной широты
     * @param int $eMinutes - минуты восточной широты
     * @param int $eSeconds - секунды восточной широты
     * @return str 
     */
    public static function convertGeoCoordinateToString($nDegress, $nMinutes, $nSeconds, $eDegress, $eMinutes, $eSeconds) {
        
        if (($nDegress + $eDegress) == 0) {
            return '-';
        }
        
        $format = "%'.02d°%'.02d'%05.2f\"N %'.02d°%'.02d'%05.2f\"E";
        
        $strGeo = sprintf($format, $nDegress, $nMinutes, $nSeconds, $eDegress, $eMinutes, $eSeconds);
        
        return $strGeo;
    }
    
    /**
     * Возвращает текстовое представление этапа получения координат
     * @param int $steep
     * @return string
     */
    public static function getStepOfObtainingCoordinates($steep) {
        
        if ($steep == 1) {
            return 'При плануванні';
        }
        
        return 'В бурінні';
    }
    
    /**
     * Преобразовывает timestamp int в формат dd.mm.yyyy
     * @param int $timestamp
     * @return string
     */
    public static function displayDate($timestamp) {
        
        $timestamp = intval($timestamp);
        
        if (! $timestamp) {
            return '-';
        }
        
        return date('d.m.Y', $timestamp);
    }
    
    /**
     * Возвращает этап бурения скважины
     * @param int $dateBuilding
     * @param int $dateDrilling
     * @param int $dateDemount
     * @param int $dateTransfer
     * @return string
     */
    private static function getStageDrilling($dateBuilding, $dateDrilling, $dateDemount, $dateTransfer) {
        
        $date = time();
        
        $timestampDateBuilding = strtotime($dateBuilding);
        $timestampDateDrilling = strtotime($dateDrilling);
        $timestampDateDemount = strtotime($dateDemount);
        $timestampDateTransfer = strtotime($dateTransfer);
        
        //если не заданы значения
        if ($timestampDateTransfer == 0) return '-';
        
        if ($date > $timestampDateTransfer) return 'Передано';
        
        if ($date > $timestampDateDemount) return 'Демонтаж';
        
        if ($date > $timestampDateDrilling) return 'Буріння';
        
        if ($date > $timestampDateBuilding) return 'Монтаж';
        
        return  'Планується';
    }
    
    /**
     * Получение краткой информации о буровых
     * @return array <p>Массив с информацией о буровых</p>
     */
    public static function getDrillsList()
    {
        $drillsList = [];
        
        $db = Db::getConnection();
        
        $sql = 'SELECT id, number, name, note FROM drill ORDER BY id ASC';
        
        $result = $db->query($sql);
        
        $i=0;
        while ($row = $result->fetch()) {
            $drillsList[$i]['id'] = $row['id'];
            $drillsList[$i]['number'] = $row['number'];
            $drillsList[$i]['name'] = $row['name'];
            $drillsList[$i]['note'] = $row['note'];
            $i++;
        }
        
        return $drillsList;
    }
    
    /**
     * Удаление буровой по ее id
     * @param int $id <p>id буровой, которую необходимо удалить</p>
     * @return boolean <p>результат выполнения запроса DELETE</p>
     */
    public static function deleteDrillById($id)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM drill WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    /**
     * Добавление новой буровой
     * @param array $options <p>массив свойств новой буровоъ</p>
     * @return boolean <p>результат выполнения запроса INSERT</p>
     */
    public static function createDrill($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT IGNORE INTO drill (number, drill_type_id, name, nld, nlm, nls, '
                . 'eld, elm, els, coordinate_stage, address, phone_number, '
                . 'date_building, date_drilling, date_demount, date_transfer, '
                . 'date_refresh, email, note) '
                . 'VALUES '
                . '(:number, :drill_type_id, :name, :nld, :nlm, :nls, :eld, :elm, :els, '
                . ':coordinate_stage, :address, :phone_number, :date_building, :date_drilling, '
                . ':date_demount, :date_transfer, :date_refresh, :email, :note)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':number', $options['number'], PDO::PARAM_STR);
        $result->bindParam(':drill_type_id', $options['drill_type_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':nld', $options['nld'], PDO::PARAM_INT);
        $result->bindParam(':nlm', $options['nlm'], PDO::PARAM_INT);
        $result->bindParam(':nls', $options['nls'], PDO::PARAM_STR);
        $result->bindParam(':eld', $options['eld'], PDO::PARAM_INT);
        $result->bindParam(':elm', $options['elm'], PDO::PARAM_INT);
        $result->bindParam(':els', $options['els'], PDO::PARAM_STR);
        $result->bindParam(':coordinate_stage', $options['coordinate_stage'], PDO::PARAM_INT);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':date_building', $options['date_building'], PDO::PARAM_STR);
        $result->bindParam(':date_drilling', $options['date_drilling'], PDO::PARAM_STR);
        $result->bindParam(':date_demount', $options['date_demount'], PDO::PARAM_STR);
        $result->bindParam(':date_transfer', $options['date_transfer'], PDO::PARAM_STR);
        $result->bindParam(':date_refresh', $options['date_refresh'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        
        return $result->execute();;
    }
    
    /**
     * Обновление информации о сотруднике
     * @param integer $id <p>id сотрудника, информацию о котором необходимо обновить</p>
     * @param array $options <p>массив с информацией о сотруднике</p>
     * @return boolean <p>результат выполнения запроса UPDATE</p>
     */
    public static function updateDrillById($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE drill SET '
                . 'number = :number, '
                . 'drill_type_id = :drill_type_id, '
                . 'name = :name, '
                . 'nld = :nld, '
                . 'nlm = :nlm, '
                . 'nls = :nls, '
                . 'eld = :eld, '
                . 'elm = :elm, '
                . 'els = :els, '
                . 'coordinate_stage = :coordinate_stage, '
                . 'address = :address, '
                . 'phone_number = :phone_number, '
                . 'date_building = :date_building, '
                . 'date_drilling = :date_drilling, '
                . 'date_demount = :date_demount, '
                . 'date_transfer = :date_transfer, '
                . 'date_refresh = :date_refresh, '
                . 'email = :email, '
                . 'note = :note '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':number', $options['number'], PDO::PARAM_STR);
        $result->bindParam(':drill_type_id', $options['drill_type_id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':nld', $options['nld'], PDO::PARAM_INT);
        $result->bindParam(':nlm', $options['nlm'], PDO::PARAM_INT);
        $result->bindParam(':nls', $options['nls'], PDO::PARAM_STR);
        $result->bindParam(':eld', $options['eld'], PDO::PARAM_INT);
        $result->bindParam(':elm', $options['elm'], PDO::PARAM_INT);
        $result->bindParam(':els', $options['els'], PDO::PARAM_STR);
        $result->bindParam(':coordinate_stage', $options['coordinate_stage'], PDO::PARAM_INT);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':date_building', $options['date_building'], PDO::PARAM_STR);
        $result->bindParam(':date_drilling', $options['date_drilling'], PDO::PARAM_STR);
        $result->bindParam(':date_demount', $options['date_demount'], PDO::PARAM_STR);
        $result->bindParam(':date_transfer', $options['date_transfer'], PDO::PARAM_STR);
        $result->bindParam(':date_refresh', $options['date_refresh'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        
        return $result->execute();
    }
}
