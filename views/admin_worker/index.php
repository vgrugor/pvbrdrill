<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
    </div>
</div>
<div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">Керування працівниками</h2>
                <br/>
                <p class="text-right">
                    <a href="/admin/worker/create">
                        <i class="fas fa-plus-circle"></i>
                        Додати працівника
                    </a>
                </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Посада</th>
                        <th scope="col">ПІБ</th>
                        <th scope="col">Примітка</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($workers as $worker): ?>
                    <tr>
                        <th scope="row"><?=$worker['id']?></tр>
                        <td><?=$worker['position_name']?></td>
                        <td><?=$worker['name']?></td>
                        <td><?=$worker['note']?></td>
                        <td><a href="#" title="Створити заявку/">VPN</a></td>
                        <td>
                            <a href="/admin/worker/update/<?=$worker['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="/admin/worker/delete/<?=$worker['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <?=$pagination->get()?>
            </nav>
        </div>
    </div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

