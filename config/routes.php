<?php

    return [
        
        'drill/([0-9]+)' => 'drill/view/$1',            //детально о буровой
        'drilllist' => 'drill/index',                   //экшен actionList в контроллере DrillController
        
        'workerlist/page-([0-9]+)' => 'worker/list/$1',     //постраничный вывод списка работников
        'worker/([0-9]+)' => 'worker/view/$1', //
        'workerlist' => 'worker/list',                  //экшен actionList в контроллере WorkerController
        
        'user/login' => 'user/login',                   //страница для входа
        'user/logout' => 'user/logout',                 //экшен выхода
        
        'contacts' => 'site/contact',                   //форма обратной связи
        
        'admin/drilltype' => 'AdminDrillType/index',    //Админка со списком типов буровых
        
        'admin/drill/delete/([0-9]+)' => 'AdminDrill/delete/$1',    //Удаление буровых
        'admin/drill' => 'AdminDrill/index',           //Админка со списком буровых
        
        'admin/organization/delete/([0-9]+)' => 'AdminOrganization/delete/$1',  //Удаление организации
        'admin/organization' => 'AdminOrganization/index',  //Админка со списком организаций
        
        'admin/department/delete/([0-9]+)' => 'AdminDepartment/delete/$1',      //Удаление отдела
        'admin/department' => 'AdminDepartment/index',  //Админка со списком отделов
        
        'admin/division/delete/([0-9]+)' => 'AdminDivision/delete/$1',       //Удаление подразделения
        'admin/division' => 'AdminDivision/index',      //Админка со списком подразделений
        
        'admin/position/delete/([0-9]+)' => 'AdminPosition/delete/$1',      //Удаление должностей
        'admin/position' => 'AdminPosition/index',      //Админка со списком должностей
        
        'admin/worker/page-([0-9]+)' => 'AdminWorker/index/$1',     //Админка со списком работников постранично
        'admin/worker/delete/([0-9]+)' => 'AdminWorker/delete/$1',  //Удаление работников
        'admin/worker' => 'AdminWorker/index',          //Админка со списком работников
        
        'admin/internetstatus' => 'AdminInternetStatus/index',  //Админка со списком состояний для интернета на буровой
        
        'admin/vpnstatus' => 'AdminVpnStatus/index',    //Админка со списком работников
        
        'admin/user' => 'AdminUser/index',              //Админка со списком работников
        
        'admin' => 'admin/index',                       //главная админки
        
        '' => 'site/index'                              //главная
    ];

