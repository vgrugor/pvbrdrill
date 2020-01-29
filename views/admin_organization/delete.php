<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/organization">Керування організаціями</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Видалення організації #<?=$id?>
                </li>
            </ol>
        </nav>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">
            Ви дійсно бажаєте видалити організацію <br/>
            <?=$organization['name']?> (<?=$organization['address']?>)?
        </h1>
        <form method="post" class="text-center">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a class="btn btn-primary" href="/admin/organization" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

