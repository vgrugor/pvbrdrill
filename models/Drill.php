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
                . 'actual_stage_id, date_actual_stage_refresh, '
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
            return 'В бурінні';
        }
        return 'При плануванні';
    }
      
    /**
     * Возвращает этап бурения скважины
     * @param array $allDate <p>массив с датами изменения состояний, должен содержать ключи:</p>
     * <p>date_building - дата начала монтажа</p>
     * <p>date_drilling - дата начала бурения</p>
     * <p>date_demount - дата начала демонтажа</p>
     * <p>date_transfer - дата передачи заказчику</p>
     * <p>@return string</p>
     */
    private static function getStageDrilling($allDate) {
        
        $date = time();
        
        $dateBuilding = $allDate['date_building'];
        $dateDrilling = $allDate['date_drilling'];
        $dateDemount = $allDate['date_demount'];
        $dateTransfer = $allDate['date_transfer'];
        
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
                . 'date_refresh, actual_stage_id, date_actual_stage_refresh, email, note) '
                . 'VALUES '
                . '(:number, :drill_type_id, :name, :nld, :nlm, :nls, :eld, :elm, :els, '
                . ':coordinate_stage, :address, :phone_number, :date_building, :date_drilling, '
                . ':date_demount, :date_transfer, :date_refresh, :actual_stage_id, '
                . ':date_actual_stage_refresh, :email, :note)';
        
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
        $result->bindParam(':actual_stage_id', $options['actual_stage_id'], PDO::PARAM_INT);
        $result->bindParam(':date_actual_stage_refresh', $options['date_actual_stage_refresh'], PDO::PARAM_STR);
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
        
        $sql = 'UPDATE IGNORE drill SET '
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
                . 'actual_stage_id = :actual_stage_id, '
                . 'date_actual_stage_refresh = :date_actual_stage_refresh, '
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
        $result->bindParam(':actual_stage_id', $options['actual_stage_id'], PDO::PARAM_INT);
        $result->bindParam(':date_actual_stage_refresh', $options['date_actual_stage_refresh'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':note', $options['note'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Информация о интернете на буровых
     * @return array <p>массив с информацией о интернете на буровых</p>
     */
    public static function getInfoAboutInternet()
    {
        $db = Db::getConnection();
        
        $internetInfo = [];
        
        $sql = 'SELECT drill.name as drill '
                . 'FROM drill';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $internetInfo[$i]['drill'] = $row['drill'];
            $i++;
        }
        return $internetInfo;
    }
    
    /**
     * Информация о ковре бурения
     * @return array <p>массив с информацией о ковре бурения</p>
     */
    public static function getCarpetDrilling()
    {
        $db = Db::getConnection();
        
        $carpet = [];
        
        $sql = 'SELECT drill.name as drill, '
                . 'date_building, '
                . 'date_drilling, '
                . 'date_demount, '
                . 'date_transfer, '
                . 'date_refresh, '
                . 'note '
                . 'FROM drill';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $carpet[$i]['drill'] = $row['drill'];
            $carpet[$i]['date_building'] = $row['date_building'];
            $carpet[$i]['date_drilling'] = $row['date_drilling'];
            $carpet[$i]['date_demount'] = $row['date_demount'];
            $carpet[$i]['date_transfer'] = $row['date_transfer'];
            $carpet[$i]['date_refresh'] = $row['date_refresh'];
            $carpet[$i]['note'] = $row['note'];
            $carpet[$i]['stage'] = Drill::getStageDrilling($row);
            $i++;
        }
        return $carpet;
    }
    
    /**
     * Получение контактов буровой
     * @return array <p>массив с контактами буровой</p>
     */
    public static function getContacts()
    {
        $db = Db::getConnection();
        
        $contacts = [];
        
        $sql = 'SELECT name as drill, '
                . 'phone_number, '
                . 'email, '
                . 'address '
                . 'FROM drill';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $contacts[$i]['drill'] = $row['drill'];
            $contacts[$i]['phone_number'] = $row['phone_number'];
            $contacts[$i]['email'] = $row['email'];
            $contacts[$i]['address'] = $row['address'];
            $i++;
        }
        return $contacts;
    }
    
    /**
     * Получение информации о расположении буровых
     * @return array $location <p>массив с информациэй о расположении буровых</p>
     */
    public static function getLocation()
    {
        $db = Db::getConnection();
        
        $location = [];
        
        $sql = 'SELECT name as drill, '
                . 'nld, nlm, nls, eld, elm, els, '
                . 'coordinate_stage '
                . 'FROM drill';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $location[$i]['drill'] = $row['drill'];
            $location[$i]['coordinate_stage'] = self::getStepOfObtainingCoordinates($row['coordinate_stage']);
            $location[$i]['geo'] = self::convertGeoCoordinateToString($row['nld'], $row['nlm'], $row['nls'], $row['eld'], $row['elm'], $row['els']);
            $location[$i]['gps'] = self::convertCoordinateGeoToGPS($row['nld'], $row['nlm'], $row['nls'], $row['eld'], $row['elm'], $row['els']);
            $i++;
        }
        return $location;
    }
    
    /**
     * Получение общей информации о буровой
     * @return array <p>массив со свойствами буровой</p>
     */
    public static function getGeneralInfo()
    {
        $db = Db::getConnection();
        
        $general = [];
        
        $sql = 'SELECT drill.id as drill_id, '
                . 'drill.name as drill, '
                . 'number, '
                . 'note, '
                . 'date_building, '
                . 'date_drilling, '
                . 'date_demount, '
                . 'date_transfer, '
                . 'actual_stage_id, '
                . 'date_actual_stage_refresh, '
                . 'actual_stage.name as stage_actual, '
                . 'drill_type.name as type '
                . 'FROM drill '
                . 'LEFT JOIN drill_type '
                . 'ON drill_type.id = drill.drill_type_id '
                . 'LEFT JOIN actual_stage '
                . 'ON drill.actual_stage_id = actual_stage.id';
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $general[$i]['id'] = $row['drill_id'];
            $general[$i]['number'] = $row['number'];
            $general[$i]['type'] = $row['type'];
            $general[$i]['drill'] = $row['drill'];
            $general[$i]['note'] = $row['note'];
            $general[$i]['stage'] = Drill::getStageDrilling($row);
            $general[$i]['stage_actual'] = $row['stage_actual'];
            $general[$i]['date_actual_stage_refresh'] = Drill::getDate($row['date_actual_stage_refresh']);
            $i++;
        }
        return $general;
    }
}
