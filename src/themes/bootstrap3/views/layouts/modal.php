<?php echo $this->Doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $this->title ? $this->title . ' - ' : ''; ?>Administrare - Forum Media Romania</title>
	<?php echo $this->Meta(); ?>

<?php
        $this->Stylesheets()->setPack(false)
            ->add('admin/bootstrap')
            ->add('admin/bootstrap-responsive')
            ->add('admin/layout')
            ->add('admin/ico')
            ->add('admin/tinymce')
            ->add('admin/forms')
            ->add('admin/modal/basic')
            ->add('admin/modal/structure')
            ->add('admin/modal/forms');
        
    $this->Stylesheets()->add('ie6', 'lte IE 6');
?>

    <?php echo $this->Stylesheets(); ?>

	<script type="text/javascript">
		var APP = {
			path: {
				root : 	'<?php echo BASE_URL; ?>',
				images: '<?php echo IMAGES_URL; ?>',
				flash: 	'<?php echo FLASH_URL; ?>',
				scripts:'<?php echo SCRIPTS_URL; ?>'
			}
		}
	</script>

<?php
    $this->Scripts()->setPack(false)
                    ->add('prototype')
                    ->add("sizzle")
                    ->add("builder")
                    ->add("effects")
                    ->add("controls")
                    ->add("dragdrop")
                    ->add("admin/modal/swfupload")
                    ->add("admin/modal/cropper")
                    ->add("admin/modal/handlers")
                    ->add("admin/modal/common");
?>

    <?php echo $this->Scripts(); ?>
</head>
<body>
    <div id="main">
        <?php echo $this->render("content"); ?>
    </div>
</body>
</html>