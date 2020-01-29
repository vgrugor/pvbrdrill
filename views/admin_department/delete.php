<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav area-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/department">Керування відділами</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Видалення відділу #<?=$id?>
                </li>
            </ol>
        </nav>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <h1>
            Ви дійсно бажаєте видалити відділ
            <?=$department['name']?> з id=<?=$id?>? 
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/department" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>
