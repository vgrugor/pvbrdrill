<!DOCTYPE html>
<html lang="en">
<head>
	<title>Полтавське ВБР</title>
	<meta charset="utf-8">
	<meta name="author" content="pixelhint.com">
	<meta name="description" content="La casa free real state fully responsive html5/css3 home page website template"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	
        <link rel="stylesheet" type="text/css" href="/template/css/reset.css">
        <link rel="stylesheet" type="text/css" href="/template/css/responsive.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script type="text/javascript" src="/template/js/jquery.js"></script>
        <script type="text/javascript" src="/template/js/main.js"></script>
        
        
</head>
<body>

	<section class="hero">
		<header>
			<div class="wrapper">
                            <a href="#"><img src="/template/images/logo.png" class="logo" alt="" titl=""/></a>
				<a href="#" class="hamburger"></a>
				<nav>
					<ul>
						<li><a href="/drill">Бурові</a></li>
						<li><a href="/worker">Працівники</a></li>
						<li><a href="#">Техніка</a></li>
						<li><a href="#">Операції</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
					<a href="#" class="login_btn">Login</a>
				</nav>
			</div>
		</header><!--  end header section  -->

			<section class="caption">
				<h2 class="caption">Полтавське ВБР</h2>
				<h3 class="properties">Філія БУ "Укрбургаз"</h3>
			</section>
	</section><!--  end hero section  -->


	<section class="search">
		<div class="wrapper">
			<form action="#" method="post">
				<input type="text" id="search" name="search" placeholder="What are you looking for?"  autocomplete="off"/>
				<input type="submit" id="submit_search" name="submit_search"/>
			</form>
			<a href="#" class="advanced_search_icon" id="advanced_search_btn"></a>
		</div>

		<div class="advanced_search">
			<div class="wrapper">
				<span class="arrow"></span>
				<form action="#" method="post">
					<div class="search_fields">
						<input type="text" class="float" id="check_in_date" name="check_in_date" placeholder="Check In Date"  autocomplete="off">

						<hr class="field_sep float"/>

						<input type="text" class="float" id="check_out_date" name="check_out_date" placeholder="Check Out Date"  autocomplete="off">
					</div>
					<div class="search_fields">
						<input type="text" class="float" id="min_price" name="min_price" placeholder="Min. Price"  autocomplete="off">

						<hr class="field_sep float"/>

						<input type="text" class="float" id="max_price" name="max_price" placeholder="Max. price"  autocomplete="off">
					</div>
					<input type="text" id="keywords" name="keywords" placeholder="Keywords"  autocomplete="off">
					<input type="submit" id="submit_search" name="submit_search"/>
				</form>
			</div>
		</div><!--  end advanced search section  -->
	</section><!--  end search section  -->

	<section class="listings">
		<div class="wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center">Загальна інформація</h2>
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
                                            <td><?=$drillItem['drill_type_id']?></td>
                                            <td><a href="drill/<?=$drillItem['id']?>"> <?=$drillItem['name']?></a></td>
                                            <td></td>
                                            <td></td>
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
                                    
                                    
                                    <!--
					<a href="/news/<?=$newsItem['id']?>">
                                            <img src="/template<?=$newsItem['preview']?>" alt="" title="" class="property_img"/>
					</a>
					<div class="property_details">
						<h1>
							<a href="/news/<?=$newsItem['id']?>"><?=$newsItem['title']?></a>
						</h1>
						<h2><?=$newsItem['short_content']?><span class="property_size">(288ftsq)</span></h2>
					</div>
                                    -->
				
			<div class="more_listing">
				<a href="#" class="more_listing_btn">View More Listings</a>
			</div>
		</div>
	</section>	<!--  end listing section  -->

	<footer>
		<div class="wrapper footer">
			<ul>
				<li class="links">
					<ul>
						<li><a href="#">About</a></li>
						<li><a href="#">Support</a></li>
						<li><a href="#">Terms</a></li>
						<li><a href="#">Policy</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</li>

				<li class="links">
					<ul>
						<li><a href="#">Appartements</a></li>
						<li><a href="#">Houses</a></li>
						<li><a href="#">Villas</a></li>
						<li><a href="#">Mansions</a></li>
						<li><a href="#">...</a></li>
					</ul>
				</li>

				<li class="links">
					<ul>
						<li><a href="#">New York</a></li>
						<li><a href="#">Los Anglos</a></li>
						<li><a href="#">Miami</a></li>
						<li><a href="#">Washington</a></li>
						<li><a href="#">...</a></li>
					</ul>
				</li>

				<li class="about">
					<p>La Casa is real estate minimal html5 website template, designed and coded by pixelhint, tellus varius, dictum erat vel, maximus tellus. Sed vitae auctor ipsum</p>
					<ul>
						<li><a href="http://facebook.com/pixelhint" class="facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/pixelhint" class="twitter" target="_blank"></a></li>
						<li><a href="http://plus.google.com/+Pixelhint" class="google" target="_blank"></a></li>
						<li><a href="#" class="skype"></a></li>
					</ul>
				</li>
			</ul>
		</div>

		<div class="copyrights wrapper">
			Copyright © 2015 <a href="http://pixelhint.com" target="_blank" class="ph_link" title="Download more free Templates">Pixelhint.com</a>. All Rights Reserved.
		</div>
	</footer><!--  end footer  -->
	
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

