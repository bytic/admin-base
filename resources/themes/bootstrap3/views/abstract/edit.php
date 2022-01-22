<?php $delete = isset($delete) ? $delete : true; ?>

<?php echo $this->Flash()->render($this->controller); ?>

<div class="row">    
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">            
                <div class="panel-heading-btn">
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

                    <?php if ($this->existPath("/" . $this->controller . "/modules/item/top-buttons")) { ?>
                        <div class="pull-right delete" >
                            <div class="buttons inline right">
                                <?php echo $this->load("/" . $this->controller . "/modules/item/top-buttons"); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <h4 class="panel-title">
                    <?php echo $this->title; ?>		
                    <?php if ($this->existPath("/" . $this->controller . "/modules/item/title-after")) { ?>
                        <?php echo $this->load("/" . $this->controller . "/modules/item/title-after"); ?>
                    <?php } ?>
                </h4>
            </div>

            <div class="panel-body">
                <div style="max-width:800px">
                    <?php
                    $viewFile = "/" . $this->controller . "/modules/item-form";
                    if (!$this->existPath($viewFile)) {
                        $viewFile = '/abstract/modules/item-form';
                    }
                    echo $this->load($viewFile); ?>
                </div>
            </div>
        </div>
    </div>
</div>