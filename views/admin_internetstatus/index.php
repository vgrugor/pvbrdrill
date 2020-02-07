<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Керування статусами інтернету</h1>
        <p class="text-right">
            <a href="/admin/internetstatus/create">
                <i class="fas fa-plus-circle"></i>
                Додати статус для інтернету
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
                    <th scope="col">Назва</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($internetStatuses as $internetStatus): ?>
                <tr>
                    <th scope="row"><?=$internetStatus['id']?></th>
                    <td><?=$internetStatus['name']?></td>
                    <td>
                        <a href="/admin/internetstatus/update/<?=$internetStatus['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/internetstatus/delete/<?=$internetStatus['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>