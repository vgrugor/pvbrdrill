<?php
/**
 * Хлебные крошки
 *
 * @author Zver
 */
class Breadcrumb {
    private $uri;
    private $pageName;
    
    public function __construct() 
    {
        $this->uri = trim($_SERVER['REQUEST_URI'], '/\\');
        $this->pageName = require_once ROOT . '/config/breadcrumb_params.php';
    }
    
    /**
     * Формирует массив с английскими названиями страниц
     * @return array <p>массив с названиями страниц</p>
     */
    public function getPagesInArray()
    {
        $pagesArray = explode('/', $this->uri);
        foreach ($pagesArray as $page) {
            if (array_key_exists($page, $this->pageName)) {
                $pages[] = $page;
            }
        }
        return $pages;
    }
    
    /**
     * Преобразовать английское название страницы в украинское
     * @param string $pageIndex <p>английское название страницы</p>
     * @return string <p>украинское название страницы</p>
     */
    public function getPageName($pageIndex)
    {
        return $this->pageName[$pageIndex];
    }
    
    /**
     * 
     * @staticvar string $uri <p></p>
     * @param string $pageUri <p>английское название страницы</p>
     * @return string <p>uri для ссылки</p>
     */
    public function getUri($pageUri)
    {
        static $uri = '';
        $uri .= '/' . $pageUri;
        return $uri;
    }
}