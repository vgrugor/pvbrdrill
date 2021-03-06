<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Керування статусами VPN</h1>
        <br/>
        <p class="text-right">
            <a href="/admin/vpnstatus/create">
                <i class="fas fa-plus-circle"></i>
                Додати статус для VPN
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
                <?php foreach ($vpnStatuses as $vpnStatus): ?>
                <tr>
                    <th scope="row"><?=$vpnStatus['id']?></th>
                    <td><?=$vpnStatus['name']?></td>
                    <td>
                        <a href="/admin/vpnstatus/update/<?=$vpnStatus['id']?>" title="Редагувати"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="/admin/vpnstatus/delete/<?=$vpnStatus['id']?>" title="Видалити"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>