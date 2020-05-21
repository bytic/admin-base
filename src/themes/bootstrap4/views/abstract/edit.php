<?php
$delete = isset($delete) ? $delete : true;
?>

<?php if ($delete) { ?>
    <div class="pull-right buttons inline delete" style="padding-left: 10px">
        <form method="post" action="<?php echo $this->item->getDeleteURL(); ?>"
              onsubmit="return confirm('<?php echo translator()->translate('general.messages.confirm'); ?>');">
            <button type="submit" class="right btn btn-danger btn-xs">
                <i class="icon-white icon-remove"></i>
                <?php echo translator()->translate('delete'); ?>
            </button>
        </form>
    </div>
<?php } ?>

<?php if ($this->existPath("/" . $this->controller . "/modules/item/top-buttons")) { ?>
    <div class="pull-right delete">
        <div class="buttons inline right">
            <?php echo $this->load("/" . $this->controller . "/modules/item/top-buttons"); ?>
        </div>
    </div>
<?php } ?>

<?php echo $this->Flash()->render($this->controller); ?>

<?php
$viewFile = "/" . $this->controller . "/modules/item-form";
if (!$this->existPath($viewFile)) {
    $viewFile = '/abstract/modules/item-form';
}
echo $this->load($viewFile); ?>
