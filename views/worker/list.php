<?php require ROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
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
                  <td><?=$worker['drill_id']?></td>
                  <td><?=$worker['position_id']?></td>
                  <td><?=$worker['email']?></td>
                  <td><?=$worker['vpn_status_id']?></td>
                  <td><?=$worker['date_refresh']?></td>
                  <td><?=$worker['note']?></td>
                </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
    </div>
</div>
    
<?php require ROOT . '/views/layouts/footer.php'; ?>