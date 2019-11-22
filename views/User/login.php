<?php require_once ROOT . '/views/layouts/header.php'; ?>
        
    <div class="row justify-content-center">
        <div class="col-sm-4 ">
            
            <h1>Вхід в систему</h1>
            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?=$error?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <form action="#" method="post">
                <div class="form-group">
                    <label for="login">Логін</label>
                    <input type="text" name="login" value="<?=$login?>" class="form-control" id="login" placeholder="Введіть логін">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" <?=$password?> class="form-control" id="password" placeholder="******">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Увійти">
            </form>
            
        </div>
    </div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>