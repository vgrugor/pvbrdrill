<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <br/>
        <h2 class="text-center">Керування користувачами сайту</h2>
        <br/>
        <p class="text-right">
            <a href="/admin/user/create">
                <i class="fas fa-plus-circle"></i>
                Додати користувача
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
                    <th scope="col">Логін</th>
                    <th scope="col">Пароль</th>
                    <th scope="col">Роль</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?=$user['id']?></th>
                    <td><?=$user['login']?></td>
                    <td><?=$user['password']?></td>
                    <td><?=$user['role']?></td>
                    <td>
                        <a href="/admin/user/update/<?=$user['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/user/delete/<?=$user['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

