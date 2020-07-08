<?php echo $this->Doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php echo $this->load("/modules/head"); ?>
<body>
    <div id="main">
        <?php echo $this->load('/modules/header'); ?>
        
        <div class="container-fluid" style="margin-top: 65px;">
            <div class="row-fluid">
                <div class="col-md-12">
                    <?php echo $this->render('content'); ?>
                </div>
            </div>
        </div>
        
        <?php echo $this->load('/modules/footer'); ?>
    </div>
    <?php echo $this->load('/modules/footer-body'); ?>
</body>
</html>