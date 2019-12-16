<?php require ROOT . '/views/layouts/header.php'; ?>
    
<div class="row">
    <div class="col">
        <h1><?=$workerItem['worker_name']?></h1>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Транслітерація:</strong></p>
    </div>
    <div class="col">
        <?=Worker::transliterate($workerItem['worker_name'])?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Обліковий запис в AD:</strong></p>
    </div>
    <div class="col">
        
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Відділ:</strong></p>
    </div>
    <div class="col">
        
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Підрозділ:</strong></p>
    </div>
    <div class="col">
        
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Бурова:</strong></p>
    </div>
    <div class="col">
        <a href="/drill/<?=$workerItem['drill_id']?>"><?=$workerItem['drill_name']?></a>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Посада:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['position_name']?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Номер телефону:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['worker_phone_number']?>
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
        <?=$workerItem['vpn_name']?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Примітка:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['worker_note']?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Дата оновлення:</strong></p>
    </div>
    <div class="col">
        <?=$workerItem['worker_refresh']?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <p><strong>Працюэ за ПК:</strong></p>
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
    
<?php require ROOT . '/views/layouts/footer.php'; ?>