<?php

    return [
        
        'drill/([0-9]+)' => 'drill/view/$1',                                //детально о буровой
        'drilllist' => 'drill/index',                                       //экшен actionList в контроллере DrillController
        
        'workerlist/page-([0-9]+)' => 'worker/list/$1',                     //постраничный вывод списка работников
        'worker/([0-9]+)' => 'worker/view/$1', //
        'workerlist' => 'worker/list',                                      //экшен actionList в контроллере WorkerController
        
        'user/login' => 'user/login',                                       //страница для входа
        'user/logout' => 'user/logout',                                     //экшен выхода
        
        'contacts' => 'site/contact',                                       //форма обратной связи
        
        'admin/drilltype/create' => 'AdminDrillType/create',                //Добавление нового типа буровой
        'admin/drilltype/delete/([0-9]+)' => 'AdminDrilltype/delete/$1',    //Удаление типов буровых
        'admin/drilltype' => 'AdminDrillType/index',                        //Админка со списком типов буровых
        
        'admin/drill/create' => 'AdminDrill/create',                        //Добавление буровой
        'admin/drill/delete/([0-9]+)' => 'AdminDrill/delete/$1',            //Удаление буровых
        'admin/drill' => 'AdminDrill/index',                                //Админка со списком буровых
        
        'admin/organization/create' => 'AdminOrganization/create',    //создание организации
        'admin/organization/delete/([0-9]+)' => 'AdminOrganization/delete/$1',  //Удаление организации
        'admin/organization' => 'AdminOrganization/index',                  //Админка со списком организаций
        
        'admin/department/create' => 'AdminDepartment/create',              //Создание отдела
        'admin/department/delete/([0-9]+)' => 'AdminDepartment/delete/$1',  //Удаление отдела
        'admin/department' => 'AdminDepartment/index',                      //Админка со списком отделов
        
        'admin/division/create' => 'AdminDivision/create',                  //Создание подразделения
        'admin/division/delete/([0-9]+)' => 'AdminDivision/delete/$1',      //Удаление подразделения
        'admin/division' => 'AdminDivision/index',                          //Админка со списком подразделений
        
        'admin/position/delete/([0-9]+)' => 'AdminPosition/delete/$1',      //Удаление должностей
        'admin/position' => 'AdminPosition/index',                          //Админка со списком должностей
        
        'admin/worker/page-([0-9]+)' => 'AdminWorker/index/$1',             //Админка со списком работников постранично
        'admin/worker/delete/([0-9]+)' => 'AdminWorker/delete/$1',          //Удаление работников
        'admin/worker' => 'AdminWorker/index',                              //Админка со списком работников
        
        'admin/internetstatus/create' => 'AdminInternetStatus/create',      //создание нового статуса для интернета
        'admin/internetstatus/delete/([0-9]+)' => 'AdminInternetStatus/delete/$1',    //Удаление статуса интернета
        'admin/internetstatus' => 'AdminInternetStatus/index',              //Админка со списком состояний для интернета на буровой
        
        'admin/vpnstatus/create' => 'AdminVpnStatus/create',                //создание статуса VPN
        'admin/vpnstatus/delete/([0-9]+)' => 'AdminVpnStatus/delete/$1',    //удаление статуса vpn
        'admin/vpnstatus' => 'AdminVpnStatus/index',                        //Админка со списком работников
        
        'admin/user/create' => 'AdminUser/create',                          //добавление пользователя
        'admin/user/delete/([0-9]+)' => 'AdminUser/delete/$1',              //удаление пользователя
        'admin/user' => 'AdminUser/index',                                  //Админка со списком работников
        
        'admin' => 'admin/index',                                           //главная админки
        
        '' => 'site/index'                                                  //главная
    ];

