<?php require_once $this->getAdminHeader(); ?>

<div class="row">
    <div class="col-sm-12 text-center">
        <br/>
        <h1>
            Ви дійсно бажаєте видалити підрозділ 
            "<?=$division['name']?>" з id=<?=$id?>?
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/division" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>

<?php require_once $this->getAdminFooter(); ?>

