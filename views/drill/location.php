<?php require ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Розташування</h1>
        <br/>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Бурова</th>
                    <th scope="col">Герграфічні координати</th>
                    <th scope="col">GPS-координати</th>
                    <th scope="col">Координати отримано</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($locationList as $locationItem): ?>
                    <tr>
                        <td><a href="/drill/<?=$locationItem['id']?>"> <?=$locationItem['drill']?></a></td>
                        <td><?=$locationItem['geo']?></td>
                        <td><?=$locationItem['gps']?></td>
                        <td><?=$locationItem['coordinate_stage']?></td>
                    </tr>
                <?php endforeach;; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center">Карта</h2>
    </div>
</div>
<?php require ROOT . '/views/layouts/footer.php'; ?>