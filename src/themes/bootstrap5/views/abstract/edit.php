<?php
$delete = !isset($delete) || $delete;
?>

<?php if ($delete) { ?>
    <div class="pull-right buttons inline delete" style="padding-left: 10px">
        <form method="post" action="<?php echo $this->item->getDeleteURL(); ?>"
              onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
            <button type="submit" class="right btn btn-danger btn-xs">
                <i class="icon-white icon-remove"></i>
                <?php echo translator()->trans('delete'); ?>
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
?>

<div class="row">
    <div class="col col-xl-8 col-lg-10">
        <?php echo $this->load($viewFile); ?>
    </div>
</div>
