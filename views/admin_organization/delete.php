<?php require_once $this->getAdminHeader(); ?>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">
            Ви дійсно бажаєте видалити організацію <br/>
            <?=$organization['name']?> (<?=$organization['address']?>)?
        </h1>
        <form method="post" class="text-center">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a class="btn btn-primary" href="/admin/organization" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once $this->getAdminFooter(); ?>

