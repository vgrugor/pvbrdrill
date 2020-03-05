<?php require_once $this->getAdminHeader() ?>
<div class="row">
    <div class="col text-center">
        <h1>Редагувати організацію</h1>
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
                <label for="name">Відредагуйте назву організації</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$organization['name']?>">
            </div>
            <div class="form-group">
                <label for="address">Вкажіть адресу</label>
                <input type="text" name="address" id="address" class="form-control" value="<?=$organization['address']?>">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" id="note" class="form-control"><?=$organization['note']?></textarea>
            </div>
            <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>

