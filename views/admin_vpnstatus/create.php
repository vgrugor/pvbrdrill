<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <h1>Додавання нового статусу для VPN</h1>
        <br>
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
                <label for="name">Введіть назву нового статуса для VPN</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="" value="">
            </div>
            <input type="submit" name="submit" value="Додати" class="btn btn-success">
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/header.php'; ?>

