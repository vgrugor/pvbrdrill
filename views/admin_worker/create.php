<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col text-center">
        <h1>Додати працівника</h1>
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
                <label for="organization_id">Оберіть організацію</label>
                <select name="organization_id" class="form-control" id="organization_id">
                    <?php foreach ($organizations as $organization): ?>
                        <option value="<?=$organization['id']?>" <?=$organization['id'] == $options['organization_id'] ? 'selected': '' ?>><?=$organization['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Оберіть відділ</label>
                <select name="department_id" class="form-control" id="department_id">
                    <?php foreach ($departments as $department): ?>
                        <option value="<?=$department['id']?>" <?=$department['id'] == $options['department_id'] ? 'selected': '' ?>><?=$department['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="division_id">Оберіть підрозділ</label>
                <select name="division_id" class="form-control" id="division_id">
                    <option value="0"></option>
                    <?php foreach ($divisions as $division): ?>
                        <option value="<?=$division['id']?>" <?=$division['id'] == $options['division_id'] ? 'selected': '' ?>><?=$division['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="position_id">Оберіть посаду</label>
                <select name="position_id" class="form-control" id="position_id">
                    <?php foreach ($positions as $position): ?>
                        <option value="<?=$position['id']?>" <?=$position['id'] == $options['position_id'] ? 'selected': '' ?>><?=$position['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="drill_id">Оберіть свердловину</label>
                <select name="drill_id" class="form-control" id="drill_id">
                    <option value="0">Не працівник бурової</option>
                    <?php foreach ($drills as $drill): ?>
                        <option value="<?=$drill['id']?>" <?=$drill['id'] == $options['drill_id'] ? 'selected': '' ?>><?=$drill['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Прізвище Ім'я Побатькові</label>
                <input type="text" name="name" value="<?=$options['name']?>" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="account_ad">Акаунт в AD</label>
                <input type="text" name="account_ad" value="<?=$options['account_ad']?>" id="account_ad" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефону в форматі (XXX)XXX-XX-XX</label>
                <input type="text" name="phone_number" value="<?=$options['phone_number']?>" id="phone_number" class="form-control" placeholder="(XXX)XXX-XX-XX">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" value="<?=$options['email']?>" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="vpn_status_id">Стан VPN</label>
                <select name="vpn_status_id" class="form-control" id="vpn_status_id">
                    <?php foreach ($vpnStatuses as $vpnStatus): ?>
                        <option value="<?=$vpnStatus['id']?>" <?=$vpnStatus['id'] == $options['vpn_status_id'] ? 'selected': '' ?>><?=$vpnStatus['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_refresh">Дата оновлення інформації</label>
                <input type="date" name="date_refresh" value="<?=$options['date_refresh']?>" id="date_refresh" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" class="form-control" id="note"><?=$options['note']?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Додати" class="btn btn-success" role="button">
            </div>
        </form>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>