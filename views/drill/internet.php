<?php require ROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Інтернет</h1>
        <h2 class="text-right">DataGroup</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Бурова</th>
                <th scope="col">Етап буріння</th>
                <th scope="col">Стан інтернету</th>
                <th scope="col">Дата зміни стану</th>
                <th scope="col">Комплект DataGroup</th>
                <th scope="col">Примітка</th>
            </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($internetInfoList as $internetInfoItem): ?>
                    <tr>
                        <td><a href="/drill/<?=$internetInfoItem['id']?>"> <?=$internetInfoItem['drill']?></a></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <br/>
        <h2 class="text-right">Infocom</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Бурова</th>
                <th scope="col">Етап буріння</th>
                <th scope="col">Стан інтернету</th>
                <th scope="col">Дата зміни стану</th>
                <th scope="col">Примітка</th>
            </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($internetInfoList as $internetInfoItem): ?>
                    <tr>
                        <td><a href="drill/<?=$internetInfoItem['id']?>"> <?=$internetInfoItem['drill']?></a></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                        <td><?=$internetInfoItem['drill']?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php require ROOT . '/views/layouts/footer.php'; ?>