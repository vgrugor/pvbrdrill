<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Вітаємо, адміністратор!</h1>
        <br/>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="/admin/organization">Керування організаціями</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/department">Керування відділами</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/division">Керування підрозділами</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/position">Керування посадами</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/worker">Керування працівниками</a>
                <span class="badge">
                    <?= Worker::getTotalWorkers() ?>
                </span>
            </li>
            <li class="list-group-item">
                <a href="/admin/drill">Керування буровими</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/drilltype">Типи бурових</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/internetstatus">Статуси інтернету</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/vpnstatus">Статуси для vpn</a>
                <span class="badge">25</span>
            </li>
            <li class="list-group-item">
                <a href="/admin/user">Керування користувачами сайту</a>
                <span class="badge">25</span>
            </li>
        </ul>
    </div>
</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>


