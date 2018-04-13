<?php $delete = isset($delete) ? $delete : true; ?>

<div class="row">
    <div class="span12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <?php echo $this->title; ?>
                    <?php if ($this->existPath("/".$this->controller."/modules/item/title-after")) { ?>
                        <?php echo $this->load("/".$this->controller."/modules/item/title-after"); ?>
                    <?php } ?>
                </h4>

                <div class="box-icon">
                    <?php if ($delete) { ?>
                        <div class="right buttons inline delete" style="padding-left: 10px">
                            <form method="post" action="<?php echo $this->item->getDeleteURL(); ?>"
                                  onsubmit="return confirm('<?php echo translator()->translate('general.messages.confirm'); ?>');">
                                <button type="submit" class="right btn btn-danger btn-xs">
                                    <i class="icon-white icon-remove"></i>
                                    <?php echo translator()->translate('delete'); ?>
                                </button>
                            </form>
                        </div>
                    <?php } ?>

                    <?php if ($this->existPath("/".$this->controller."/modules/item/top-buttons")) { ?>
                        <div class="right delete">
                            <div class="buttons inline right">
                                <?php echo $this->load("/".$this->controller."/modules/item/top-buttons"); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>

            <div class="box-content">
                <?php echo $this->Flash()->render($this->controller); ?>

                <?php if ($this->existPath("/".$this->controller."/modules/item/right-buttons")) { ?>
                    <div class="right delete">
                        <div class="buttons inline right">
                            <?php echo $this->load("/".$this->controller."/modules/item/right-buttons"); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php echo $this->renderTabControls(); ?>
                <?php echo $this->renderTabContents(); ?>
            </div>
        </div>
    </div>
</div>