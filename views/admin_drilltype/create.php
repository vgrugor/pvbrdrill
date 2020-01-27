<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/drilltype">Керування типами бурових</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Додати тип бурової
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <h1>Додати новий тип бурової</h1>
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
                <label for="name">Введіть назву нового типу бурової</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$options['name']?>" placeholder="">
            </div>
            <input type="submit" name="submit" value="Додати" class="btn btn-success">
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

