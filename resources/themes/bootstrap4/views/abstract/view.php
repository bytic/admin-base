<?php $delete = isset($delete) ? $delete : true; ?>

<div class="card card-inverse">
    <div class="card-header">

        <?php if ($this->existPath("/" . $this->controller . "/modules/item/top-buttons")) { ?>
            <div class="pull-right delete">
                <div class="buttons inline right">
                    <?php echo $this->load("/" . $this->controller . "/modules/item/top-buttons"); ?>
                </div>
            </div>
        <?php } ?>

        <h4 class="card-title">
            <?php echo $this->title; ?>
            <?php if ($this->existPath("/" . $this->controller . "/modules/item/title-after")) { ?>
                <?php echo $this->load("/" . $this->controller . "/modules/item/title-after"); ?>
            <?php } ?>
        </h4>

        <?php if ($delete) { ?>
            <div class="pull-right buttons inline delete" style="padding-left: 10px">
                <form method="post" action="<?php echo $this->item->getDeleteURL(); ?>"
                      onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
                    <button type="submit" class="pull-right btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-white glyphicon-remove"></span>
                        <?php echo translator()->trans('delete'); ?>
                    </button>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="card-body">
        <?php echo $this->Flash()->render($this->controller); ?>

        <?php if ($this->existPath("/" . $this->controller . "/modules/item/right-buttons")) { ?>
            <div class="pull-right delete">
                <div class="buttons inline right">
                    <?php echo $this->load("/" . $this->controller . "/modules/item/right-buttons"); ?>
                </div>
            </div>
        <?php } ?>

        <?php echo $this->renderTabControls(); ?>
        <?php echo $this->renderTabContents(); ?>
    </div>
</div>