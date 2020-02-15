<option value="NULL"></option>
<?php foreach ($divisions as $division): ?>
    <option value="<?=$division['id']?>">
        <?=$division['name']?>
    </option>
<?php endforeach; ?>