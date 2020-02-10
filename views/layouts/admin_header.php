<!doctype html>
<html lang="uk">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Подключени е иконок https://fontawesome.com/icons?d=gallery&m=free-->
    <script src="https://kit.fontawesome.com/0f39bd7c71.js" crossorigin="anonymous"></script>
    <title>Полтавське ВБР</title>
  </head>
  <body>
      <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Головна</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/drilllist">Бурові</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/workerlist">Працівники</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts">Зворотній зв'язок</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Довідники</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Організації</a>
                        <a class="dropdown-item" href="#">Відділи</a>
                        <a class="dropdown-item" href="#">Підрозділи</a>
                        <a class="dropdown-item" href="#">Посади</a>
                        <a class="dropdown-item" href="#">Типи бурових</a>
                        <a class="dropdown-item" href="#">Статуси vpn</a>
                        <a class="dropdown-item" href="#">Статуси інтернету</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Адміністрування</a>
                </li>
            </ul>
            
            <div class="row justify-content-end">
                <div class="col-sm-2 text-right">
                    <?php if (User::isGuest()): ?>
                        <a href="/user/login">Вхід</a>
                    <?php else: ?>
                        <a href="/user/logout">Вихід</a>
                    <?php endif; ?>
                </div>
            </div>
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php foreach ($this->breadcrumb->getPagesInArray() as $page): ?>
                    <?php $tmp = $this->breadcrumb->getPagesInArray() ?>
                    <?php if ($page == end($tmp)): ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?=$this->breadcrumb->getPageName($page)?>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <a href="<?=$this->breadcrumb->getUri($page)?>"><?=$this->breadcrumb->getPageName($page) ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
    </div>
</div>