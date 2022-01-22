<?php echo $this->Doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo $this->load("/modules/head"); ?>
<body>
<?php echo $this->load('/modules/header'); ?>

<?php echo $this->load('/modules/sidebar', ["selected" => $this->section]); ?>

<div id="main">
    <?php echo $this->load('/modules/page-header'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->render('content'); ?>
            </div>
        </div>
    </div>
</div>

<?php echo $this->load('/modules/footer'); ?>
<?php echo $this->load('/modules/footer-body'); ?>
</body>
</html>