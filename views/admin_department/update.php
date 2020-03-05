<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col text-center">
        <h1>Редагувати відділ</h1>
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
                <label for="organization_id">Організація</label>
                <select id="organization_id" name="organization_id" class="form-control">
                    <?php if (is_array($organizations)): ?>
                        <?php foreach ($organizations as $organizationItem): ?>
                            <option value="<?=$organizationItem['id']?>" <?= $organizationItem['id'] == $department['organization_id'] ? 'selected' : "" ;?>>
                                <?=$organizationItem['name']?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Назва відділу</label>
                <input type="text" name="name" id="name" value="<?=$department['name']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефону</label>
                <input type="text" name="phone_number" id="phone_number" value="<?=$department['phone_number']?>" class="form-control" placeholder="(XXX)XXX-XX-XX">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" id="note" class="form-control"><?=$department['note']?></textarea>
            </div>
            <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>

