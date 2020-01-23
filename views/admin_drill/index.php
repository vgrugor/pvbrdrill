<?php require_once ROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <nav aria-label="breadcrump">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Адміністрування</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Керування буровими
                </li>
            </ol>
        </nav>
    </div>
</div>
    <div class="row">
        <div class="col-sm-12">
            <br/>
            <h2 class="text-center">Керування буровими</h2>
            <p class="text-right">
                <a href="/admin/drill/create">
                    <i class="fas fa-plus-circle"></i>
                    Додати бурову
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
                        <th scope="col">Номер</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Примітка</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drills as $drill): ?>
                        <tr>
                            <th scope="row"><?=$drill['id']?></th>
                            <td><?=$drill['number']?></td>
                            <td><a href="/drill/<?=$drill['id']?>"><?=$drill['name']?></a></td>
                            <td><?=$drill['note']?></td>
                            <td><a href="/admin/move/<?=$drill['id']?>" title="Перемістити"><i class="fas fa-people-carry"></i></a></td>
                            <td><a href="/admin/drill/update/<?=$drill['id']?>" title="Редагувати"><i class="far fa-edit"></i></a></td>
                            <td><a href="/admin/drill/delete/<?=$drill['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>


