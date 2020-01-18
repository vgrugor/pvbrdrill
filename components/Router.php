<?php

class Router {
    
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = require_once $routesPath;
    }
    
    /**
     * Возвращает строку запроса. 
     * Вызывается в методе Router->run()
     */
    private function getURI(){
        
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        
        //Получить строку запроса
        $uri = $this->getURI();
        
        //Проверить наличие полученного запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            //сравниваем $$uriPattern c $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                //Создаем внутренний маршрут
                $internalRoutes = preg_replace("~$uriPattern~", $path, $uri);
                
                //получаем название контролера и экшена в массив
                $segments = explode('/', $internalRoutes);
                
                //Получаем имя контроллера, удаляем его из массива $segments
                $controllerName = array_shift($segments) . 'Controller';
                
                //Делам первую букву в названии контроллера большой
                $controllerName = ucfirst($controllerName);
                
                //Получаем имя экшена, удаляем его из массива $segments
                //Делаем первую букву второго слова большой
                $actionName = 'action' . ucfirst(array_shift($segments));
                 
                //оставшиеся в массиве элементы будут переданы как параметры
                $parameters = $segments;
                
                //создаем строку с полным путем к файлу на диске
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                
                //если файл существует, то подключаем его
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                }
                
                //создаем обьект контроллера
                $controllerObject = new $controllerName;
                
                //вызываем необходимый экшен
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                
                //преываем цыкл перебора массива с роутами, если экшен отработал
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
