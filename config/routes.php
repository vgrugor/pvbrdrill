<?php

    return [
        
        'drill/([0-9]+)' => 'drill/view/$1',           //детально о буровой
        'drilllist' => 'drill/index',                      //экшен actionList в контроллере DrillController
        
        'worker/page-([0-9]+)' => 'worker/list/$1',    //постраничный вывод списка работников
        'worker/([0-9]+)' => 'worker/view/$1', //
        'workerlist' => 'worker/list',                     //экшен actionList в контроллере WorkerController
        
        'user/login' => 'user/login',                  //страница для входа
        'user/logout' => 'user/logout',                //экшен выхода
        
        'contacts' => 'site/contact',                  //форма обратной связи
        
        'admin/drill' => 'AdminDrill/index',
        'admin' => 'admin/index',                      //главная админки
        
        '' => 'site/index'                              //главная
    ];

