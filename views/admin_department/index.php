<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center">Керування відділами</h2>
            <br/>
            <p class="text-right">
                <a href="/admin/department/create">
                    <i class="fas fa-plus-circle"></i>
                    Додати відділ
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
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department): ?>
                <tr>
                    <th scope="row"><?=$department['id']?></th>
                    <td><?=$department['organization']?></td>
                    <td><?=$department['name']?></td>
                    <td>
                        <a href="/admin/department/update/<?=$department['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/department/delete/<?=$department['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

