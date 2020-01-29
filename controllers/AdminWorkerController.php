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
    
    /**
     * Страница удаления работника
     * @param type $id <p>id работника, которого нужно удалить</p>
     * @return boolean
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        
        $worker = Worker::getWorkerById($id);
        
        if (isset($_POST['submit'])) {
            Worker::deleteWorkerById($id);
            
            header("Location: /admin/worker");
        }
        
        require_once ROOT . '/views/admin_worker/delete.php';
        
        return true;
    }
}
