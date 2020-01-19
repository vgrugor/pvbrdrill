<?php require_once ROOT . '/views/layouts/header.php'; ?>
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin">Адміністрування</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Керування організаціями
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">Керування організаціями</h2>
                <br/>
                <p class="text-right">
                    <a href="/admin/organization/create">
                        <i class="fas fa-plus-circle"></i>
                        Додати організацію
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
                        <th scope="col">Адреса</th>
                        <th scope="col">Примітка</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($organizations as $organization): ?>
                    <tr>
                        <th scope="row"><?=$organization['id']?></tр>
                        <td><?=$organization['name']?></td>
                        <td><?=$organization['address']?></td>
                        <td><?=$organization['note']?></td>
                        <td>
                            <a href="/admin/organization/update/<?=$organization['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="/admin/organization/delete/<?=$organization['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>



