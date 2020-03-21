<?php require ROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Килим буріння</h1>
        <br/>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Бурова</th>
                    <th scope="col">Етап</th>
                    <th scope="col">Дата початку монтажу</th>
                    <th scope="col">Дата початку буріння</th>
                    <th scope="col">Дата початку демонтажу</th>
                    <th scope="col">Дата передачі в експлуатацію</th>
                    <th scope="col">Дата оновлення інформації</th>
                    <th scope="col">Примітка</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($coverInfoList as $coverInfoItem): ?>
                    <tr>
                        <td><a href="/drill/<?=$coverInfoItem['id']?>"> <?=$coverInfoItem['drill']?></a></td>
                        <td><?=$coverInfoItem['stage']?></td>
                        <td><?=Drill::getDate($coverInfoItem['date_building'])?></td>
                        <td><?=Drill::getDate($coverInfoItem['date_drilling'])?></td>
                        <td><?=Drill::getDate($coverInfoItem['date_demount'])?></td>
                        <td><?=Drill::getDate($coverInfoItem['date_transfer'])?></td>
                        <td><?=Drill::getDate($coverInfoItem['date_refresh'])?></td>
                        <td><?=$coverInfoItem['note']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require ROOT . '/views/layouts/footer.php'; ?>