<?php

/**
 * Управление работниками
 *
 * @author rt.hryhoriev
 */
class AdminWorkerController extends AdminBase {
    
    /**
     * Админка со списком работников
     * @return boolean
     */
    public function actionIndex($page = 1)
    {
        self::checkAdmin();
        
        $workers = Worker::getWorkerList($page);
        
        $total = Worker::getTotalWorkers();
        
        $pagination = new Pagination($total, $page, Worker::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT . '/views/admin_worker/index.php';
        
        return true;
    }
}
