<?php

/**
 * Админка типов буровых
 *
 * @author Zver
 */
class AdminDrillTypeController extends AdminBase {
    
    /**
     * Админка со списком типов буровых
     * @return boolean
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $drillTypes = DrillType::getDrillTypesList();
        
        require_once ROOT . '/views/admin_drilltype/index.php';
        
        return true;
    }
    
    /**
     * Страница удаления типа буровой
     * @param int $id <p>id типа буровой, который нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $drillType = DrillType::getDrillTypeById($id);
        
        if (isset($_POST['submit'])) {
            DrillType::deleteDrillTypeById($id);
            
            header('Location: /admin/drilltype');
        }
        
        require_once ROOT . '/views/admin_drilltype/delete.php';
        
        return true;
    }
    
    /**
     * Страница создания типа буровой
     * @return boolean
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $options['name'] = '';
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 10])) {
                $errors[] = 'Назва типу бурової має бути в межах від 4-х до 10 символів';
            }
            
            if ($errors == false) {
                DrillType::createDrillType($options);
                
                header("Location: /admin/drilltype");
            }
        }
        
        require_once ROOT . '/views/admin_drilltype/create.php';
        
        return true;
    }
    
    /**
     * Страница редактирования типа буровой
     * @param integer $id <p>id типа буровой, который следует отредактировать</p>
     * @return boolean <p>для роутера</p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $options = DrillType::getDrillTypeById($id);
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 10])) {
                $errors[] = 'Назва типу бурової має бути в межах від 4-х до 10 символів';
            }
            
            if ($errors == false) {
                DrillType::updateDrillTypeById($id, $options);
                
                header("Location: /admin/drilltype");
            }
        }
        
        require_once ROOT . '/views/admin_drilltype/update.php';
        
        return true;
    }
}
