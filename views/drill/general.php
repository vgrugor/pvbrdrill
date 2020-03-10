<?php require ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Свердловини Полтавського ВБР</h1>
        <br/>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Назва</th>
                    <th scope="col">Етап</th>
                    <th scope="col">Примітка</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($drillList as $drillItem): ?>
                    <tr>
                        <td><?=$drillItem['number']?></td>
                        <td><?=$drillItem['type']?></td>
                        <td><a href="/drill/<?=$drillItem['id']?>"> <?=$drillItem['drill']?></a></td>
                        <td><?=$drillItem['stage']?></td>
                        <td><?=$drillItem['note']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require ROOT . '/views/layouts/footer.php'; ?>

