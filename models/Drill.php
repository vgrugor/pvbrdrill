<?php


class Drill {
    
    /**
     * Возвращает информацию о одной буровой по ее id
     * @param int $id
     */
    public static function getDrillById($id) {
        
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT '
                . 'drill.id, number, drill_type.name as type_name, drill.name, '
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
            $drillItem['date_building'] = self::displayDate($drillItem['date_building']);
            $drillItem['date_drilling'] = self::displayDate($drillItem['date_drilling']);
            $drillItem['date_demount'] = self::displayDate($drillItem['date_demount']);
            $drillItem['date_transfer'] = self::displayDate($drillItem['date_transfer']);
            $drillItem['date_refresh'] = self::displayDate($drillItem['date_refresh']);
            
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
            $drillList[$i]['date_building'] = self::displayDate($row['date_building']);
            $drillList[$i]['date_drilling'] = self::displayDate($row['date_drilling']);
            $drillList[$i]['date_demount'] = self::displayDate($row['date_demount']);
            $drillList[$i]['date_transfer'] = self::displayDate($row['date_transfer']);
            $drillList[$i]['date_refresh'] = self::displayDate($row['date_refresh']);
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
        
        //если не заданы значения
        if ($dateTransfer == 0) return '-';
        
        if ($date > $dateTransfer) return 'Передано';
        
        if ($date > $dateDemount) return 'Демонтаж';
        
        if ($date > $dateDrilling) return 'Буріння';
        
        if ($date > $dateBuilding) return 'Монтаж';
        
        return  'Планується';
    }
}
