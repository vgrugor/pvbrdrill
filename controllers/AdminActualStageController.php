<?php

/**
 * Description of AdminActualStageController
 *
 * @author Zver
 */
class AdminActualStageController extends AdminBase {
    
    /**
     * Страница админки со списком фактических стадий бурения
     * @return boolean <p>для роутера<p>
     */
    public function actionIndex()
    {
        self::checkAdmin();
        
        $actualStageList = ActualStage::getActualStageList();
        
        require_once ROOT . '/views/admin_actualstage/index.php';
        
        return true;
    }
    
    /**
     * Страница создания новой фактической стадии бурения
     * @return boolean <p>для роутера<p>
     */
    public function actionCreate()
    {
        self::checkAdmin();
        
        $options['name'] = '';
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($options['name'], ['string', 4, 50])) {
                $errors[] = 'Назва для актуальної стадії буріння має містити від 4 до 50 символів';
            }
            
            if ($errors == false) {
                ActualStage::createActuslStage($options);
                
                header('Location: /admin/actualstage');
            }
        }
        require_once ROOT . '/views/admin_actualstage/create.php';
        
        return true;
    }
    
    /**
     * Страница редактирования актуальной стадии бурения
     * @param integer $id <p></p>
     * @return boolean <p>для роутера<p>
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        
        $actualStage = ActualStage::getActualStageById($id);
        
        if (isset($_POST['submit'])) {
            $actualStage['name'] = $_POST['name'];
            
            $errors = false;
            
            if (!$this->validator->make($actualStage['name'], ['string', 4, 50])) {
                $errors[] = 'Назва для актуальної стадії буріння має містити від 4 до 50 символів';
            }
            
            if ($errors == false) {
                ActualStage::updateActuslStage($id, $actualStage);
                
                header('Location: /admin/actualstage');
            }
        }
        require_once ROOT . '/views/admin_actualstage/update.php';
        
        return true;
    }

    /**
     * Страница удаления актуальной стадии бурения
     * @param integer $id <p></p>
     * @return boolean <p>для роутера<p>
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $actualStage = ActualStage::getActualStageById($id);
        
        if (isset($_POST['submit'])) {
            ActualStage::deleteActualStageById($id);
            
            header('Location: /admin/actualstage');
        }
        
        require_once ROOT . '/views/admin_actualstage/delete.php';
        
        return true;
    }
}
