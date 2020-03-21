<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col">
        <h1 class="text-center">Редагувати інформацію про підрозділ</h1>
        <br/>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-sm-6">
        <?php if (isset($errors) && is_array($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$error?>;
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="organization_id">Оберіть організацію</label>
                <select name="organization_id" class="form-control" id="organization_id">
                    <?php foreach ($organizations as $organization): ?>
                        <option value="<?=$organization['id']?>" <?= $organization['id'] == $division['organization_id'] ? 'selected' : ''; ?>>
                            <?=$organization['name']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Оберіть відділ</label>
                <select name="department_id" class="form-control" id="department_id">
                    <?php foreach ($departments as $department): ?>
                        <option value="<?=$department['id']?>" <?= $department['id'] == $division['department_id'] ? 'selected' : ''; ?>>
                            <?=$department['name']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Назва підрозділу</label>
                <input type="text" name="name" value="<?=$division['name']?>" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="note">Примітка</label>
                <textarea name="note" class="form-control" id="note"><?=$division['note']?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Зберегти" class="btn btn-warning" role="button">
            </div>
        </form>
    </div>
</div>
 <?php require_once $this->getAdminFooter(); ?>