<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col">
        <h1 class="text-center">Редагувати інформацію про бурову</h1>
        <br/>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-sm-6">
        <?php if (isset($errors) && is_array($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$error?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="number">Номер бурової</label>
                <input type="text" name="number" id="number" class="form-control" value="<?=$drill['number']?>">
            </div>
            <div class="form-group">
                <label for="drill_type_id">Тип бурової</label>
                <select name="drill_type_id" id="drill_type_id" class="form-control">
                    <?php foreach ($drillTypeList as $drillTypeItem): ?>
                        <option value="<?=$drillTypeItem['id']?>" <?= $drillTypeItem['id'] == $drill['drill_type_id'] ? 'selected' : ''?>>
                            <?=$drillTypeItem['name']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Назва бурової</label>
                <input type="text" name="name" value="<?=$drill['name']?>" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="nld">Пн.ш.<sup>0</sup></label>
                <input type="text" name="nld" value="<?=$drill['nld']?>" class="form-control" id="nld">
            </div>
            <div class="form-group">
                <label for="nlm">Пн.ш.'</label>
                <input type="text" name="nlm" value="<?=$drill['nlm']?>" class="form-control" id="nlm">
            </div>
            <div class="form-group">
                <label for="nls">Пн.ш."</label>
                <input type="text" name="nls" value="<?=$drill['nls']?>" class="form-control" id="nls">
            </div>
            <div class="form-group">
                <label for="eld">Сх.д.<sup>0</sup></label>
                <input type="text" name="eld" value="<?=$drill['eld']?>" class="form-control" id="eld">
            </div>
            <div class="form-group">
                <label for="elm">Сх.д.'</label>
                <input type="text" name="elm" value="<?=$drill['elm']?>" class="form-control" id="elm">
            </div>
            <div class="form-group">
                <label for="els">Сх.д."</label>
                <input type="text" name="els" value="<?=$drill['els']?>" class="form-control" id="els">
            </div>
            <div class="form-group">
                <label for="coordinate_stage">Координати отримано</label>
                <select name="coordinate_stage" class="form-control" id="coordinate_stage">
                    <option value="0" <?= $drill['coordinate_stage'] == 0 ? 'selected' : ''?>>При плануванні</option>
                    <option value="1" <?= $drill['coordinate_stage'] == 1 ? 'selected' : ''?>>В бурінні</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Адреса</label>
                <textarea name="address" id="address" class="form-control"><?=$drill['address']?></textarea>
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефону в форматі (ХХХ)ХХХ-ХХ-ХХ</label>
                <input type="text" name="phone_number" value="<?=$drill['phone_number']?>" id="phone_number" class="form-control" placeholder="(XXX)XXX-XX-XX">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" value="<?=$drill['email']?>" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="date_building">Дата початку монтажу</label>
                <input type="date" name="date_building" value="<?=$drill['date_building']?>" class="form-control" id="date_building">
            </div>
            <div class="form-group">
                <label for="date_drilling">Дата початку буріння</label>
                <input type="date" name="date_drilling" value="<?=$drill['date_drilling']?>" class="form-control" id="date_drilling">
            </div>
            <div class="form-group">
                <label for="date_demount">Дата початку демонтажу</label>
                <input type="date" name="date_demount" value="<?=$drill['date_demount']?>" class="form-control" id="date_demount">
            </div>
            <div class="form-group">
                <label for="date_transfer">Дата здачі в експлуатацію</label>
                <input type="date" name="date_transfer" value="<?=$drill['date_transfer']?>" class="form-control" id="date_transfer">
            </div>
            <div class="form-group">
                <label for="date_refresh">Дата оновлення інформації</label>
                <input type="date" name="date_refresh" value="<?=$drill['date_refresh']?>" class="form-control" id="date_refresh">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" class="form-control" id="note"><?=$drill['note']?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
            </div>
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>
