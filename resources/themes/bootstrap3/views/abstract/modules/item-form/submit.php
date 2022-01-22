<?php
    if (!$label) {
        $label = "Salveaza";
    }
?>

<div class="buttons nomargin">
    <button type="submit">
        <img src="<?php echo $this->Url()->image('ico/disk.png'); ?>" alt="" />
        <?php echo $label; ?>
    </button>
    <div class="clear"></div>
</div>
