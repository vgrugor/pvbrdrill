<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center">Керування посадами</h2>
        <p class="text-right">
            <a href="/admin/position/create">
                <i class="fas fa-plus-circle"></i>
                Додати посаду
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
                    <th scope="col">Організація</th>
                    <th scope="col">Відділ</th>
                    <th scope="col">Підрозділ</th>
                    <th scope="col">Посада</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($positions as $position): ?>
                <tr>
                    <th scope="row"><?=$position['id']?></th>
                    <td><?=$position['organization']?></td>
                    <td><?=$position['department']?></td>
                    <td><?=$position['division']?></td>
                    <td><?=$position['name']?></td>
                    <td>
                        <a href="/admin/position/update/<?=$position['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/position/delete/<?=$position['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

