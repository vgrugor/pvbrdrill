<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col-sm-12 text-center">
        <h1>
            Ви дійсно бажаєте видалити відділ
            <?=$department['name']?> з id=<?=$id?>? 
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/department" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>
