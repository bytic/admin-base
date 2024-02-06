<?php
$delete = $delete ?? true;
?>

<div class="card">
    <div class="card-header">
        <?php if ($this->existPath("/" . $this->controller . "/modules/item/top-buttons")) { ?>
            <div class="pull-right delete">
                <div class="buttons inline right">
                    <?php echo $this->load("/" . $this->controller . "/modules/item/top-buttons"); ?>
                </div>
            </div>
        <?php } ?>

        <h4 class="card-title">
            <?= $this->title; ?>
            <?php if ($this->existPath("/" . $this->controller . "/modules/item/title-after")) { ?>
                <?= $this->load("/" . $this->controller . "/modules/item/title-after"); ?>
            <?php } ?>
        </h4>

        <?php if ($delete) { ?>
            <div class="pull-right buttons inline delete" style="padding-left: 10px">
                <form method="post" action="<?php echo $this->item->getDeleteURL(); ?>"
                      onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
                    <button type="submit" class="pull-right btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-white glyphicon-remove"></span>
                        <?= translator()->trans('delete'); ?>
                    </button>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="card-body">
        <?= $this->Flash()->render($this->controller); ?>

        <?php if ($this->existPath("/" . $this->controller . "/modules/item/right-buttons")) { ?>
            <div class="pull-right delete">
                <div class="buttons inline right">
                    <?= $this->load("/" . $this->controller . "/modules/item/right-buttons"); ?>
                </div>
            </div>
        <?php } ?>

        <?= $this->renderTabControls(); ?>
        <?= $this->renderTabContents(); ?>
    </div>
</div>