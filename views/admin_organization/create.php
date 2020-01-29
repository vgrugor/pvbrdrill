<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/organization">Керування організаціями</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Додати організацію
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <h1>Додати нову організацію</h1>
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
                <label for="name">Введіть назву організації</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$options['name']?>">
            </div>
            <div class="form-group">
                <label for="address">Вкажіть адресу</label>
                <input type="text" name="address" id="address" class="form-control" value="<?=$options['address']?>">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" id="note" class="form-control"><?=$options['note']?></textarea>
            </div>
            <input type="submit" name="submit" value="Додати" class="btn btn-success" role="button">
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

