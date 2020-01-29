<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrump">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Керування типами бурових
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Керування типами бурових</h1>
        <p class="text-right">
            <a href="/admin/drilltype/create">
                <i class="fas fa-plus-circle"></i>
                Додати тип бурових
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
                <?php foreach ($drillTypes as $drillType): ?>
                <tr>
                    <th scope="row"><?=$drillType['id']?></th>
                    <td><?=$drillType['name']?></td>
                    <td>
                        <a href="/admin/drilltype/update/<?=$drillType['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/drilltype/delete/<?=$drillType['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

