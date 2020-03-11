<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Керування фактичними стадіями буріння</h1>
        <br/>
        <p class="text-right">
            <a href="/admin/actualstage/create">
                <i class="fas fa-plus-circle"></i>
                Додати фактичну стадію буріння
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
                <?php foreach ($actualStageList as $actualStageItem): ?>
                <tr>
                    <th scope="row"><?=$actualStageItem['id']?></th>
                    <td><?=$actualStageItem['name']?></td>
                    <td>
                        <a href="/admin/actualstage/update/<?=$actualStageItem['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/actualstage/delete/<?=$actualStageItem['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>