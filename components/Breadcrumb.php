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
     * Формирует массив страниц для хлебных крошек без лишних элементов из url
     * @return array <p>массив с названиями страниц</p>
     */
    private function getPagesInArray()
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
     * Формирует оформление для хлебных крошек
     * @return string <p>bootstrap элемент breadcrumb</p>
     */
    public function getBreadcrumb()
    {
        $arrayPages = $this->getPagesInArray();
        $uri = '';
        
        $breadcrumb = '<nav aria-label="breadcrumb">';
        $breadcrumb .= '<ol class="breadcrumb">';
        
        foreach ($arrayPages as $page) {
            $uri .= '/' . $page; 
            if ($page == end($arrayPages)) {
                $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">';
                $breadcrumb .= $this->pageName[$page];
                $breadcrumb .= '</li>';
            } else {
                $breadcrumb .= '<li class="breadcrumb-item">';
                $breadcrumb .= '<a href="' . $uri . '">';
                $breadcrumb .= $this->pageName[$page];
                $breadcrumb .='</a></li>';
            }
        }
        $breadcrumb .= '</ol></nav>';
        
        return $breadcrumb;
    }
}