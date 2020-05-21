<?php $delete = isset($delete) ? $delete : true; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card panel-inverse">
            <div class="card-header">
                <div class="card-header-btn">
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

                <h4 class="card-title">
                    <?php echo $this->title; ?>
                    <?php if ($this->existPath("/".$this->controller."/modules/item/title-after")) { ?>
                        <?php echo $this->load("/".$this->controller."/modules/item/title-after"); ?>
                    <?php } ?>
                </h4>
            </div>

            <div class="card-body">
                <?php echo $this->Flash()->render($this->controller); ?>

                <?php
                $viewFile = "/".$this->controller."/modules/item-form";
                if (!$this->existPath($viewFile)) {
                    $viewFile = '/abstract/modules/item-form';
                }
                echo $this->load($viewFile); ?>
            </div>
        </div>
    </div>
</div>