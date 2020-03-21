<?php foreach ($positions as $position): ?>
    <option value="<?=$position['id']?>">
        <?=$position['name']?>
    </option>
<?php endforeach; ?>
echo $sql;