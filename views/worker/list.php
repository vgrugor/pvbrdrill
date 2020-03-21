<?php require ROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Список працівників</h1>
        <br/>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ПІБ</th>
              <th scope="col">Бурова</th>
              <th scope="col">Посада</th>
              <th scope="col">email</th>
              <th scope="col">vpn</th>
              <th scope="col">Дата оновлення</th>
              <th scope="col">Примітка</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($workerList as $worker): ?>
                <tr>
                  <td><a href="/worker/<?=$worker['id']?>"><?=$worker['name']?></a></td>
                  <td><?=$worker['drill']?></td>
                  <td><?=$worker['position_name']?></td>
                  <td><?=$worker['email']?></td>
                  <td><?=$worker['vpn_status_name']?></td>
                  <td><?=Worker::getDate($worker['date_refresh'])?></td>
                  <td><?=$worker['note']?></td>
                </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <nav aria-label="Page navigation example">
            <?=$pagination->get()?>
        </nav>
    </div>
</div>
    
<?php require ROOT . '/views/layouts/footer.php'; ?>