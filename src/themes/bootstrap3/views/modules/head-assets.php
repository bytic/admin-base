<?php
echo $this->Stylesheets();
?>

<script type="text/javascript">
    var APP = {
        path: {
            root: '<?php //echo BASE_URL; ?>',
            images: '<?php //echo IMAGES_URL; ?>',
            flash: '<?php //echo FLASH_URL; ?>',
            scripts: '<?php //echo SCRIPTS_URL; ?>',
            stylesheets: '<?php //echo STYLESHEETS_URL; ?>'
        }
    }
</script>