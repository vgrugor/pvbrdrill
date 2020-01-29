<?php require_once ROOT . '/views/layouts/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            
            <?php if ($result): ?>
                <p>Повідомлення успішно відправлено!</p>
            <?php else: ?>
                

                <h1>Створити повідомлення</h1>
                <p>Повідомлення та пропозиції</p>
                <br>
                <?php if (isset($errors)  && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?=$error?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="userEmail">Ваш email</label>
                        <input type="email" name="userEmail" value="<?=$userEmail?>" class="form-control" id='userEmail' placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="userText">Уведіть Ваше повідомлення</label>
                        <textarea name="userText" class="form-control" id="userText" placeholder="Текст повідомлення"><?=$userText?></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Надіслати">
                </form>
                
            <?php endif; ?>
        </div>
    </div>

<?php require_once ROOT . '/views/layouts/footer.php';