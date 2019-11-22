<?php require ROOT . '/views/layouts/header.php'; ?>
                    <div class="row">
                         <div class="col-sm-12">
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
                                            <td><?=$drillItem['type_name']?></td>
                                            <td><a href="/drill/<?=$drillItem['id']?>"> <?=$drillItem['name']?></a></td>
                                            <td><?=$drillItem['stage']?></td>
                                            <td><?=$drillItem['note']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row">
			<div class="col-sm-12">
                            <h2 class="text-center">Інтернет</h2>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
					<th scope="col">Бурова</th>
					<th scope="col">Стан інтернету</th>
					<th scope="col">Комплект DataGroup</th>
					<th scope="col">Дата зміни стану</th>
					<th scope="col">Примітка</th>
                                    </tr>
				</thead>
				<tbody class="table-striped">
                                    <?php foreach ($drillList as $drillItem): ?>
					<tr>
                                            <td><a href="drill/<?=$drillItem['id']?>"> <?=$drillItem['name']?></a></td>
                                            <td><?=$drillItem['name']?></td>
                                            <td><?=$drillItem['name']?></td>
                                            <td><?=$drillItem['name']?></td>
                                            <td><?=$drillItem['name']?></td>
					</tr>
                                    <?php endforeach ?>
				</tbody>
                            </table>
			</div>
                    </div>

                    <div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Килим буріння</h2>
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
                                            <?php foreach ($drillList as $drillItem): ?>
                                            <tr>
                                                <td><?=$drillItem['name']?></td>
                                                <td><?=$drillItem['stage']?></td>
                                                <td><?=$drillItem['date_building']?></td>
                                                <td><?=$drillItem['date_drilling']?></td>
                                                <td><?=$drillItem['date_demount']?></td>
                                                <td><?=$drillItem['date_transfer']?></td>
                                                <td><?=$drillItem['date_refresh']?></td>
                                                <td><?=$drillItem['note']?></td>
                                            </tr>
                                            <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Контакти</h2>
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Бурова</th>
							<th scope="col">Телефон</th>
							<th scope="col">email</th>
							<th scope="col">Адреса</th>
						</tr>
					</thead>
					<tbody class="table-striped">
						<?php foreach ($drillList as $drillItem): ?>
                                            <tr>
                                                <td><?=$drillItem['name']?></td>
                                                <td><?=$drillItem['phone_number']?></td>
                                                <td><a href="mailto:<?=$drillItem['email']?>"><?=$drillItem['email']?></a></td>
                                                <td><?=$drillItem['address']?></td>
                                            </tr>
                                                <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Розташування</h2>
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
						<?php foreach ($drillList as $drillItem): ?>
                                                    <tr>
                                                        <td><?=$drillItem['name']?></td>
                                                        <td><?=$drillItem['geo']?></td>
                                                        <td><?=$drillItem['gps']?></td>
                                                        <td><?=$drillItem['coordinate_stage']?></td>
                                                    </tr>
                                                <?php endforeach;; ?>
					</tbody>
				</table>
			</div>
		</div>

                <div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Матриця відстаней до бурових</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Розміщення бурових Полтавського ВБР</h2>
				<figure class="figure">
					<img src="..." class="figure-img img-fluid rounded" alt="...">
					<figcaption class="figure-caption">A caption for the above image.</figcaption>
				</figure>
			</div>
		</div>
<?php require ROOT . '/views/layouts/footer.php'; ?>

