<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/drilltype">Керування типами бурових</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Видалення типу бурової #<?=$id?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <br/>
        <h1>
            Ви дійсно бажаєте видалити тип бурової
            "<?=$drillType['name']?>" з id=<?=$id?>?
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/drilltype" class="btn btn-primary" role="button>">Ні</a> 
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>
