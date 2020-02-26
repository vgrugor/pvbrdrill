<option value="0"></option>
<?php foreach ($divisions as $division): ?>
    <option value="<?=$division['id']?>">
        <?=$division['name']?>
    </option>
<?php endforeach; ?>