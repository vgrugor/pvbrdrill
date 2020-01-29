<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/vpnstatus">Керування статусами VPN</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Видалення статусу VPN
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <br/>
        <h1>
            Ви дійсно бажаєте видалити статус VPN
            <?=$vpnStatus['name']?> з id=<?=$id?>?
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/vpnstatus" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

