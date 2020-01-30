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
            $options['email'] = $_POST['email'];
            $options['note'] = $_POST['note'];
            
            $errors = false;
            
            if (!Validator::validationDrillNumber($options['number'])) {
                $errors[] = 'Номер бурової має починатися мінімум з 2-ох цифр і містити від 3-ох до 5-и символів';
            }
            
            if (!Validator::validationDrillName($options['name'])) {
                $errors[] = 'Назва бурової має містити від 6 до 50 символів';
            }
            
            if (!Validator::validationCoordinateDegrees($options['nld'])) {
                $errors[] = 'Градуси північної широти мають бути цілим числом від 0 до 359';
            }
            
            if (!Validator::validationCoordinateMinutes($options['nlm'])) {
                $errors[] = 'Мінути північної широти мають бути цілим числом від 0 до 59';
            }
            
            if (!Validator::validationCoordinateSeconds($options['nls'])) {
                $errors[] = 'Секунди північної широти мають бути числом від 0 до 59';
            }
            
            if (!Validator::validationCoordinateDegrees($options['eld'])) {
                $errors[] = 'Градуси східної довготи мають бути цілим числом від 0 до 359';
            }
            
            if (!Validator::validationCoordinateMinutes($options['elm'])) {
                $errors[] = 'Мінути східної довготи мають бути цілим числом від 0 до 59';
            }
            
            if (!Validator::validationCoordinateSeconds($options['els'])) {
                $errors[] = 'Секунди східної довготи мають бути числом від 0 до 59';
            }
            
            if (!Validator::validationMobilePhoneNumber($options['phone_number'])) {
                $errors[] = 'Номер телефону не відповідає встановленому формату';
            }
            
            if (!Validator::validationDate($options['date_building'])) {
                $errors[] = '';
            }
            
            if (!Validator::validationDate($options['date_drilling'])) {
                $errors[] = '';
            }
            
            if (!Validator::validationDate($options['date_demount'])) {
                $errors[] = '';
            }
            
            if (!Validator::validationDate($options['date_transfer'])) {
                $errors[] = '';
            }
            
            if (!Validator::validationDate($options['date_refresh'])) {
                $errors[] = '';
            }
            
            if (!Validator::validationEmail($options['email'])) {
                $errors[] = '';
            }
            
            if ($errors == false) {
                Drill::createDrill($options);
                
                header('Location: /admin/drill');
            }
            require_once ROOT . '/views/admin_drill/create.php';
            
            return true;
        }
    }
}

