<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/department">Керування відділами</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Додати відділ
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <h1>Додати новий відділ</h1>
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
                <label for="organization_id">Оберіть потрібну організацію</label>
                <select id="organization_id" name="organization_id" class="form-control">
                    <?php if (is_array($organizationsList)): ?>
                        <?php foreach ($organizationsList as $organizationItem): ?>
                            <option value="<?=$organizationItem['id']?>" <?= $organizationItem['id'] == $options['organization_id'] ? 'selected' : "" ;?>>
                                <?=$organizationItem['name']?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Введіть назву відділу</label>
                <input type="text" name="name" id="name" value="<?=$options['name']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Вкажіть номер телефону</label>
                <input type="text" name="phone_number" id="phone_number" value="<?=$options['phone_number']?>" class="form-control" placeholder="(XXX)XXX-XX-XX">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" id="note" class="form-control"><?=$options['note']?></textarea>
            </div>
            <input type="submit" name="submit" value="Додати" class="btn btn-success" role="button">
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>

