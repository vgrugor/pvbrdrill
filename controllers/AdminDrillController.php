<?php

/**
 * Description of AdminDrillController
 *
 * @author Zver
 */
class AdminDrillController extends AdminBase {
    
    /**
     * Админка со списком буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drills = Drill::getDrillsList();
        
        require_once ROOT . '/views/admin_drill/index.php';
        
        return true;
    }
    
    
    /**
     * Страница удаления буровой
     * @param int $id <p>id буровой, которую нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $drill = Drill::getDrillById($id);
        
        if (isset($_POST['submit'])) {
            Drill::deleteDrillById($id);
            
            header('Location: /admin/drill');
        }
        
        require_once ROOT . '/views/admin_drill/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания буровой
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $drillTypeList = DrillType::getDrillTypesList();
        
        $actualStageList = ActualStage::getActualStageList();
        
        $options['number'] = '';
        $options['drill_type_id'] = '';
        $options['name'] = '';
        $options['nld'] = '';
        $options['nlm'] = '';
        $options['nls'] = '';
        $options['eld'] = '';
        $options['elm'] = '';
        $options['els'] = '';
        $options['coordinate_stage'] = '';
        $options['address'] = '';
        $options['phone_number'] = '';
        $options['date_building'] = '';
        $options['date_drilling'] = '';
        $options['date_demount'] = '';
        $options['date_transfer'] = '';
        $options['date_refresh'] = '';
        $options['actual_stage_id'] = '';
        $options['date_actual_stage_refresh'] = '';
        $options['email'] = '';
        $options['note'] = '';
        
        if (isset($_POST['submit'])) {
            $options['number'] = $_POST['number'];
            $options['drill_type_id'] = $_POST['drill_type_id'];
            $options['name'] = $_POST['name'];
            $options['nld'] = $_POST['nld'];
            $options['nlm'] = $_POST['nlm'];
            $options['nls'] = $_POST['nls'];
            $options['eld'] = $_POST['eld'];
            $options['elm'] = $_POST['elm'];
            $options['els'] = $_POST['els'];
            $options['coordinate_stage'] = $_POST['coordinate_stage'];
            $options['address'] = $_POST['address'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['date_building'] = $_POST['date_building'];
            $options['date_drilling'] = $_POST['date_drilling'];
            $options['date_demount'] = $_POST['date_demount'];
            $options['date_transfer'] = $_POST['date_transfer'];
            $options['date_refresh'] = $_POST['date_refresh'];
            $options['actual_stage_id'] = $_POST['actual_stage_id'];
            $options['date_actual_stage_refresh'] = $_POST['date_actual_stage_refresh'];
            $options['email'] = $_POST['email'];
            $options['note'] = $_POST['note'];
            
            $errors = false;
            
            if (!$this->validator->make($options['number'], ['string', 0, 5])) {
                $errors[] = 'Номер бурової має містити до 5-и символів';
            }
            
            if (!$this->validator->make($options['name'], ['string', 6, 50])) {
                $errors[] = 'Назва бурової має містити від 6 до 50 символів';
            }
            
            if (!$this->validator->make($options['nld'], ['numeric', 0, 359])) {
                $errors[] = 'Градуси північної широти мають бути числом від 0 до 359';
            }
            
            if (!$this->validator->make($options['nlm'], ['numeric', 0, 59])) {
                $errors[] = 'Мінути північної широти мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($options['nls'], ['numeric', 0, 59])) {
                $errors[] = 'Секунди північної широти мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($options['eld'], ['numeric', 0, 359])) {
                $errors[] = 'Градуси східної довготи мають бути цілим числом від 0 до 359';
            }
            
            if (!$this->validator->make($options['elm'],['numeric', 0, 59])) {
                $errors[] = 'Мінути східної довготи мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($options['els'], ['numeric', 0, 59])) {
                $errors[] = 'Секунди східної довготи мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($options['phone_number'], ['MobileNumber'])) {
                $errors[] = 'Номер телефону не відповідає встановленому формату';
            }
            
            if (!$this->validator->make($options['date_building'],['date'])) {
                $errors[] = 'Дата початку монтажу повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['date_drilling'], ['date'])) {
                $errors[] = 'Дата початку буріння повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['date_demount'], ['date'])) {
                $errors[] = 'Дата початку демонтажу повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['date_transfer'], ['date'])) {
                $errors[] = 'Дата передачі бурової замовнику повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['date_refresh'], ['date'])) {
                $errors[] = 'Дата оновлення інформації повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['date_actual_stage_refresh'], ['date'])) {
                $errors[] = 'Дата оновлення інформації про фактичний етап буріння повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($options['email'], ['email'])) {
                $errors[] = 'Некоректний email';
            }
            
            if ($errors == false) {
                Drill::createDrill($options);
                
                header('Location: /admin/drill');
            }    
        }
        require_once ROOT . '/views/admin_drill/create.php';
            
        return true;
    }
    
    /**
     * Страница редактирования информации о буровой
     * @param integer $id <p>id буровой, информацию о которой нужно обновить</p>
     * @return boolean <p>для роутера</p>
     */
     public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $drillTypeList = DrillType::getDrillTypesList();
        
        $actualStageList = ActualStage::getActualStageList();
        
        $drill = Drill::getDrillById($id);
        
        if (isset($_POST['submit'])) {
            $drill['number'] = $_POST['number'];
            $drill['drill_type_id'] = $_POST['drill_type_id'];
            $drill['name'] = $_POST['name'];
            $drill['nld'] = $_POST['nld'];
            $drill['nlm'] = $_POST['nlm'];
            $drill['nls'] = $_POST['nls'];
            $drill['eld'] = $_POST['eld'];
            $drill['elm'] = $_POST['elm'];
            $drill['els'] = $_POST['els'];
            $drill['coordinate_stage'] = $_POST['coordinate_stage'];
            $drill['address'] = $_POST['address'];
            $drill['phone_number'] = $_POST['phone_number'];
            $drill['date_building'] = $_POST['date_building'];
            $drill['date_drilling'] = $_POST['date_drilling'];
            $drill['date_demount'] = $_POST['date_demount'];
            $drill['date_transfer'] = $_POST['date_transfer'];
            $drill['date_refresh'] = $_POST['date_refresh'];
            $drill['actual_stage_id'] = $_POST['actual_stage_id'];
            $drill['date_actual_stage_refresh'] = $_POST['date_actual_stage_refresh'];
            $drill['email'] = $_POST['email'];
            $drill['note'] = $_POST['note'];
            
            $errors = false;
            
            if (!$this->validator->make($drill['number'], ['string', 0, 5])) {
                $errors[] = 'Номер бурової має містити до 5-и символів';
            }
            
            if (!$this->validator->make($drill['name'], ['string', 6, 50])) {
                $errors[] = 'Назва бурової має містити від 6 до 50 символів';
            }
            
            if (!$this->validator->make($drill['nld'], ['numeric', 0, 359])) {
                $errors[] = 'Градуси північної широти мають бути числом від 0 до 359';
            }
            
            if (!$this->validator->make($drill['nlm'], ['numeric', 0, 59])) {
                $errors[] = 'Мінути північної широти мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($drill['nls'], ['numeric', 0, 59])) {
                $errors[] = 'Секунди північної широти мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($drill['eld'], ['numeric', 0, 359])) {
                $errors[] = 'Градуси східної довготи мають бути цілим числом від 0 до 359';
            }
            
            if (!$this->validator->make($drill['elm'],['numeric', 0, 59])) {
                $errors[] = 'Мінути східної довготи мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($drill['els'], ['numeric', 0, 59])) {
                $errors[] = 'Секунди східної довготи мають бути числом від 0 до 59';
            }
            
            if (!$this->validator->make($drill['phone_number'], ['MobileNumber'])) {
                $errors[] = 'Номер телефону не відповідає встановленому формату';
            }
            
            if (!$this->validator->make($drill['date_building'],['date'])) {
                $errors[] = 'Дата початку монтажу повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['date_drilling'], ['date'])) {
                $errors[] = 'Дата початку буріння повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['date_demount'], ['date'])) {
                $errors[] = 'Дата початку демонтажу повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['date_transfer'], ['date'])) {
                $errors[] = 'Дата передачі бурової замовнику повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['date_refresh'], ['date'])) {
                $errors[] = 'Дата оновлення інформації повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['date_actual_stage_refresh'], ['date'])) {
                $errors[] = 'Дата оновлення інформації про фактичний етап буріння повинна відповідати формату дд.мм.рррр';
            }
            
            if (!$this->validator->make($drill['email'], ['email'])) {
                $errors[] = 'Некоректний email';
            }
            
            if ($errors == false) {
                Drill::updateDrillById($id, $drill);
                
                header('Location: /admin/drill');
            }    
        }
        
        require_once ROOT . '/views/admin_drill/update.php';
        
        return true;
    }
}

