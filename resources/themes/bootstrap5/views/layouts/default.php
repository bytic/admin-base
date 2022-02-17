<?= $this->Doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?= $this->load("/modules/head"); ?>
<body>
<div id="page-container" class="page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
    <?= $this->load('/modules/header'); ?>

    <?= $this->load('/modules/sidebar', ["selected" => $this->section]); ?>

    <div id="content" class="content">
        <?= $this->load('/modules/page-header'); ?>

        <div class="inner">
            <?= $this->render('content'); ?>
        </div>
    </div>

    <?= $this->load('/modules/footer'); ?>
</div>

<?= $this->load('/modules/footer-body'); ?>
</body>
</html>