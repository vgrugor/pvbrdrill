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
    
    /**
     * Форма обратной связи
     * @return boolean
     */
    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = false;
            
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Недопустимий email!';
            }
            
            if ($errors == false) {
                $mail = 'v.hryhoriev@ukrburgas.com.ua';
                $subject = 'Зворотній зв\'язок';
                $result = mail($mail, $subject, $userText);
            }
        }
        
        require_once ROOT . '/views/site/contact.php';
        
        return true;
    }
}
