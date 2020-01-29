<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/position">Керування посадами</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Видалення посади #<?=$id?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <br/>
        <h1>
            Ви дійсно бажаєте видалити посаду 
            "<?=$position['pos_name']?>" (<?=$position['dep_name']?>) 
            в організації <?=$position['org_name']?>?
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/position" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>
