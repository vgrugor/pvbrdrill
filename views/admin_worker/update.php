<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col text-center">
        <h1>Редагувати інформацію про працівника</h1>
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
                    <?php if (is_array($organizations)): ?>
                        <?php foreach ($organizations as $organization): ?>
                            <option value="<?=$organization['id']?>" <?=$organization['id'] == $worker['organization_id'] ? 'selected': '' ?>><?=$organization['name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Оберіть відділ</label>
                <select name="department_id" class="form-control" id="department_id">
                    <?php if (is_array($departments)): ?>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?=$department['id']?>" <?=$department['id'] == $worker['department_id'] ? 'selected': '' ?>><?=$department['name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="division_id">Оберіть підрозділ</label>
                <select name="division_id" class="form-control" id="division_id">
                    <option value="0"></option>
                    <?php if (is_array($divisions)): ?>
                        <?php foreach ($divisions as $division): ?>
                            <option value="<?=$division['id']?>" <?=$division['id'] == $worker['division_id'] ? 'selected': '' ?>><?=$division['name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="position_id">Оберіть посаду</label>
                <select name="position_id" class="form-control" id="position_id">
                    <?php if (is_array($positions)): ?>
                        <?php foreach ($positions as $position): ?>
                            <option value="<?=$position['id']?>" <?=$position['id'] == $worker['position_id'] ? 'selected': '' ?>><?=$position['name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="drill_id">Оберіть свердловину</label>
                <select name="drill_id" class="form-control" id="drill_id">
                    <option value="0">Не працівник бурової</option>
                    <?php foreach ($drills as $drill): ?>
                        <option value="<?=$drill['id']?>" <?=$drill['id'] == $worker['drill_id'] ? 'selected': '' ?>><?=$drill['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Прізвище Ім'я Побатькові</label>
                <input type="text" name="name" value="<?=$worker['name']?>" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="account_ad">Акаунт в AD</label>
                <input type="text" name="account_ad" value="<?=$worker['account_ad']?>" id="account_ad" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефону в форматі (XXX)XXX-XX-XX</label>
                <input type="text" name="phone_number" value="<?=$worker['phone_number']?>" id="phone_number" class="form-control" placeholder="(XXX)XXX-XX-XX">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" value="<?=$worker['email']?>" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="vpn_status_id">Стан VPN</label>
                <select name="vpn_status_id" class="form-control" id="vpn_status_id">
                    <?php if (is_array($vpnStatuses)): ?>
                        <?php foreach ($vpnStatuses as $vpnStatus): ?>
                            <option value="<?=$vpnStatus['id']?>" <?=$vpnStatus['id'] == $worker['vpn_status_id'] ? 'selected': '' ?>><?=$vpnStatus['name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_refresh">Дата оновлення інформації</label>
                <input type="date" name="date_refresh" value="<?=$worker['date_refresh']?>" id="date_refresh" class="form-control">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" class="form-control" id="note"><?=$worker['note']?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
            </div>
        </form>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>