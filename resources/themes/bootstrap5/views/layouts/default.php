<?php echo $this->Doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo $this->load("/modules/head"); ?>
<body>
<div id="page-container" class="page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
    <?php echo $this->load('/modules/header'); ?>

    <?php echo $this->load('/modules/sidebar', ["selected" => $this->section]); ?>

    <div id="content" class="content">
        <?php echo $this->load('/modules/page-header'); ?>

        <div class="inner">
            <?php echo $this->render('content'); ?>
        </div>
    </div>

    <?php echo $this->load('/modules/footer'); ?>
</div>

<?php echo $this->load('/modules/footer-body'); ?>
</body>
</html>