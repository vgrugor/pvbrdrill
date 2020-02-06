<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->breadcrumb->getBreadcrumb(); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <br/>
        <h1>
            Ви дійсно бажаєте видалити статус інтернету
            "<?=$internetStatus['name']?>" з id=<?=$id?>?
        </h1>
        <form method="post">
            <input type="submit" name="submit" value="Так" class="btn btn-danger">
            <a href="/admin/internetstatus" class="btn btn-primary" role="button">Ні</a>
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>

