<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col-sm-12">
        <br/>
        <h2 class="text-center">Керування підрозділами</h2>
        <p class="text-right">
            <a href="/admin/division/create">
                <i class="fas fa-plus-circle"></i>
                Додати підрозділ
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
                    <th scope="col">Відділ</th>
                    <th scope="col">Підрозділ</th>
                    <th scope="col">Примітка</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($divisions as $division): ?>
                <tr>
                    <th scope="row"><?=$division['id']?></th>
                    <td><?=$division['department']?></td>
                    <td><?=$division['name']?></td>
                    <td><?=$division['note']?></td>
                    <td>
                        <a href="/admin/division/update/<?=$division['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/division/delete/<?=$division['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>


