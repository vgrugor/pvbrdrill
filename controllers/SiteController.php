<?php

/**
 * Description of SiteController
 *
 * @author rt.hryhoriev
 */
class SiteController {
    
    public function actionIndex() {
        
        require_once ROOT . '/views/site/index.php';
    }
}
