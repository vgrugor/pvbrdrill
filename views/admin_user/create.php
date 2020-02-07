<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col text-center">
        <h1>Додати нового користувача</h1>
        <br/>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-sm-6">
        <?php if (isset($errors) && is_array($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$error?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="login">Введіть логін користувача</label>
                <input type="text" name="login" id="login" value="<?=$options['login']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Введіть пароль користувача</label>
                <input type="password" name="password" value="<?=$options['password']?>" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label for="role">Вкажіть роль користувача</label>
                <select name="role" id="role" class="form-control">
                    <option value="user" <?= $options['role'] == 'user' ? 'selected' : '' ?>>Користувач</option>
                    <option value="admin" <?= $options['role'] == 'admin' ? 'selected' : '' ?>>Адміністратор</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Додати" class="btn btn-success" role="button">
        </form>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>

