<?php require ROOT . '/views/layouts/header.php'; ?>
    
    <div class="row">
        <div class="col-sm-5">
            <h1><?=$drillItem['name']?></h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Тип:</strong></p>
        </div>
        <div class="col">
            <?=$drillItem['type_name']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Номер:</strong></p>
        </div>
        <div class="col">
            <?=$drillItem['number']?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>GEO-координати:</strong></p>
        </div>
        <div class="col">
            <?=$drillItem['geo']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>GPS-координати:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['gps']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Координати отримано:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['coordinate_stage']?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Адреса:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['address']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Номер телефону:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['phone_number']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Email:</strong></p>
        </div>
        <div class="col-sm-5">
            <a href="mailto:<?=$drillItem['email']?>"><?=$drillItem['email']?></a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Дата початку монтажу:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['date_building']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Дата початку буріння:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['date_drilling']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Дата початку демонтажу:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['date_demount']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Дата передачі в експлуатацію:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['date_transfer']?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Дата оновлення інформації:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['date_refresh']?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <p><strong>Примітка:</strong></p>
        </div>
        <div class="col-sm-5">
            <?=$drillItem['note']?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-5 ">
            <h2>Працівники:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Посада</th>
                    <th scope="col">ПІБ</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">email</th>
                    <th scope="col">Дата оновлення</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($workers as $worker):?>
                        <tr>
                          <td><?=$worker['position_name']?></td>
                          <td><?=$worker['name']?></td>
                          <td><?=$worker['phone_number']?></td>
                          <td><?=$worker['email']?></td>
                          <td><?=$worker['date_refresh']?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 ">
            <h2>Забезпечення комп'ютерами:</h2>
        </div>
    </div>
<?php require ROOT . '/views/layouts/footer.php'; ?>