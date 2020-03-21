<?php require ROOT . '/views/layouts/header.php'; ?>
    
<div class="row">
    <div class="col">
        <h1><?=$workerItem['name']?></h1>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Транслітерація:</strong></p>
    </div>
    <div class="col">
        <?=Worker::getTranslitName($workerItem['name'])?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Обліковий запис в AD:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['account_ad']?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Організація:</strong></p>
    </div>
    <div class="col">
        <?=$organization['name']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Відділ:</strong></p>
    </div>
    <div class="col">
        <?=$department['name']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Підрозділ:</strong></p>
    </div>
    <div class="col">
        <?=$division['name']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Посада:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['position']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Бурова:</strong></p>
    </div>
    <div class="col">
        <a href="/drill/<?=$workerItem['drill_id']?>"><?=$workerItem['drill']?></a>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Номер телефону:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['phone_number']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Email:</strong></p>
    </div>
    <div class="col">
        <a href="mailto:<?=$workerItem['email']?>"><?=$workerItem['email']?></a>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>vpn:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['vpn_status']?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Примітка:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['note']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Дата оновлення:</strong></p>
    </div>
    <div class="col">
        <?= Worker::getDate($workerItem['worker_refresh'])?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Працює за ПК:</strong></p>
    </div>
    <div class="col">
        
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Користувача налаштовано на ПК:</strong></p>
    </div>
    <div class="col">
        
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <a href="#" data-toggle="collapse" data-target="#hide-me">Підпис для пошти</a>
        <div id="hide-me" class="collapse in">
            <p>
                З повагою,<br>
                <?=$workerItem['name']?><br>
                <?=$workerItem['position']?> 
                <?=$workerItem['drill']?>
            <p>
            
            <p>
                Полтавське ВБР<br>
                БУ «Укрбургаз» <br>
                АТ «Укргазвидобування»
            </p>
            <img src="/template/images/worker/view/logo.jpg">

            <p>
                вул. Ковалівська, 5<br>
                м. Полтава, 36015, а/с 1715, Україна
            </p>

            <p>
                Тел.: <?=$workerItem['phone_number']?><br>
                <?=$workerItem['email']?>
            </p>
        </div>
    </div>
</div>

    
<?php require ROOT . '/views/layouts/footer.php'; ?>