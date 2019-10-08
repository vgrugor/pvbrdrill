<?php

    return [
        '/drill/([0-9]+)' => 'drill/view/$1',
        '/drill' => 'drill/list', //экшен actionList в контроллере DrillController
        '/worker/([0-9]+)' => 'worker/view/$1', //
        '/worker' => 'worker/list'  //экшен actionList в контроллере WorkerController
    ];

