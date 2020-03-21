<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col text-center">
        <h1>Редагувати інформацію про користувача</h1>
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
                <label for="login">Логін користувача</label>
                <input type="text" name="login" id="login" value="<?=$user['login']?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Пароль користувача</label>
                <input type="password" name="password" value="<?=$user['password']?>" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label for="role">Роль користувача</label>
                <select name="role" id="role" class="form-control">
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>Користувач</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Адміністратор</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
        </form>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>

