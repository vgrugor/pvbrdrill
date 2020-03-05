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
        
        'admin/drilltype/update/([0-9]+)' => 'AdminDrillType/update/$1',    //Редактирование типа буровой
        'admin/drilltype/create' => 'AdminDrillType/create',                //Добавление нового типа буровой
        'admin/drilltype/delete/([0-9]+)' => 'AdminDrilltype/delete/$1',    //Удаление типов буровых
        'admin/drilltype' => 'AdminDrillType/index',                        //Админка со списком типов буровых
        
        'admin/drill/create' => 'AdminDrill/create',                        //Добавление буровой
        'admin/drill/update/([0-9]+)' => 'AdminDrill/update/$1',            //Редактирование информации о буровой
        'admin/drill/delete/([0-9]+)' => 'AdminDrill/delete/$1',            //Удаление буровых
        'admin/drill' => 'AdminDrill/index',                                //Админка со списком буровых
        
        'admin/organization/update/([0-9]+)' => 'AdminOrganization/update/$1',  //Редактирование организации
        'admin/organization/create' => 'AdminOrganization/create',              //создание организации
        'admin/organization/delete/([0-9]+)' => 'AdminOrganization/delete/$1',  //Удаление организации
        'admin/organization' => 'AdminOrganization/index',                      //Админка со списком организаций
        
        'admin/department/ajaxlist/([0-9]+)' => 'AdminDepartment/ajaxlist/$1', //заполнение выпадающего списка ajax
        'admin/department/update/([0-9]+)' => 'AdminDepartment/update/$1',  //редактирование отдела
        'admin/department/create' => 'AdminDepartment/create',              //Создание отдела
        'admin/department/delete/([0-9]+)' => 'AdminDepartment/delete/$1',  //Удаление отдела
        'admin/department' => 'AdminDepartment/index',                      //Админка со списком отделов
        
        'admin/division/ajaxlist' => 'AdminDivision/ajaxlist',              //заполнение выпадающего списка ajax
        'admin/division/update/([0-9]+)' => 'AdminDivision/update/$1',      //Редактирование подразделения
        'admin/division/create' => 'AdminDivision/create',                  //Создание подразделения
        'admin/division/delete/([0-9]+)' => 'AdminDivision/delete/$1',      //Удаление подразделения
        'admin/division' => 'AdminDivision/index',                          //Админка со списком подразделений
        
        'admin/position/ajaxlist/([0-9]+)/([0-9]+)' => 'AdminPosition/ajaxlist/$1/$2',  //заполнение выпадающего списка ajax
        'admin/position/update/([0-9]+)' => 'AdminPosition/update/$1',      //Редактирование должности
        'admin/position/create' => 'AdminPosition/create',                  //Добавление должности
        'admin/position/delete/([0-9]+)' => 'AdminPosition/delete/$1',      //Удаление должностей
        'admin/position' => 'AdminPosition/index',                          //Админка со списком должностей
        
        'admin/worker/create' => 'AdminWorker/create',                      //Добавление работника
        'admin/worker/update/([0-9]+)' => 'AdminWorker/update/$1',          //Редактирование информации о работнике
        'admin/worker/page-([0-9]+)' => 'AdminWorker/index/$1',             //Админка со списком работников постранично
        'admin/worker/delete/([0-9]+)' => 'AdminWorker/delete/$1',          //Удаление работников
        'admin/worker' => 'AdminWorker/index',                              //Админка со списком работников
        
        'admin/internetstatus/update/([0-9]+)' => 'AdminInternetStatus/update/$1',  //редактирование статуса
        'admin/internetstatus/create' => 'AdminInternetStatus/create',      //создание нового статуса для интернета
        'admin/internetstatus/delete/([0-9]+)' => 'AdminInternetStatus/delete/$1',    //Удаление статуса интернета
        'admin/internetstatus' => 'AdminInternetStatus/index',              //Админка со списком состояний для интернета на буровой
        
        'admin/vpnstatus/update/([0-9]+)' => 'AdminVpnStatus/update/$1',    //редактирование статуса
        'admin/vpnstatus/create' => 'AdminVpnStatus/create',                //создание статуса VPN
        'admin/vpnstatus/delete/([0-9]+)' => 'AdminVpnStatus/delete/$1',    //удаление статуса vpn
        'admin/vpnstatus' => 'AdminVpnStatus/index',                        //Админка со списком работников
        
        'admin/user/update/([0-9]+)' => 'AdminUser/update/$1',              //Редактирование информации о пользователе
        'admin/user/create' => 'AdminUser/create',                          //добавление пользователя
        'admin/user/delete/([0-9]+)' => 'AdminUser/delete/$1',              //удаление пользователя
        'admin/user' => 'AdminUser/index',                                  //Админка со списком работников
        
        'admin' => 'admin/index',                                           //главная админки
        
        '' => 'site/index'                                                  //главная
    ];

