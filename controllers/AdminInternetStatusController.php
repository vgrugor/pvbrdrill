<?php

/**
 * Состояния интернета на буровых
 *
 * @author Zver
 */
class AdminInternetStatusController extends AdminBase {
    
    /**
     * Страница админка состояний интернета на буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $internetStatuses = InternetStatus::getInternetStatusesList();
        
        require_once ROOT . '/views/admin_internetstatus/index.php';
        
        return true;
    }
    
    /**
     * Страница удаления статусов интернета
     * @param int $id <p>id статуса интернета, который следует удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $internetStatus = InternetStatus::getInternetStatusById($id);
        
        if (isset($_POST['submit'])) {
            InternetStatus::deleteInternetStatusById($id);
            
            header('Location: /admin/internetstatus');
        }
        
        require_once ROOT . '/views/admin_internetstatus/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания нового статуса интернета
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 50])) {
                $errors[] = 'Довжина назви статусу інтернету має бути в межах від 4-х до 50-и символи.';
            }
            
            if ($errors == false) {
                InternetStatus::createInternetStatus($options);
                
                header('Location: /admin/internetstatus');
            }
        }
        
        require_once ROOT . '/views/admin_internetstatus/create.php';
        
        return true;
    }
    
    
    /**
     * Редактирование статуса интернета по его id
     * @param integer $id <p>id статуса интернета для обновления</p>
     * @return boolean <p>для роутера</p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $internetStatus = InternetStatus::getInternetStatusById($id);
        
        if (isset($_POST['submit'])) {
            $internetStatus['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($internetStatus['name'], ['string', 4, 50])) {
                $errors[] = 'Довжина назви статусу інтернету має бути в межах від 4-х до 50-и символи.';
            }
            
            if ($errors == false) {
                InternetStatus::updateInternetStatusById($id, $internetStatus);
                
                header('Location: /admin/internetstatus');
            }
        }
        require_once ROOT . '/views/admin_internetstatus/update.php';
        
        return true;
    }
}
