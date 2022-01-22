<?php
if (!$this->existPath("/" . $this->controller . "/modules/filters")) {
    return;
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-inverse">
            <div class="card-header">
                <h4 class="card-title">
                    <?php echo translator()->trans('filters'); ?>
                </h4>
            </div>

            <div class="card-body">
                <form method="get" action="<?php echo $this->modelManager->getURL(); ?>" id="filter-form"
                      class="filters">
                    <div class="row">
                        <?php echo $this->load("/" . $this->controller . "/modules/filters"); ?>

                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-large">
                                <span class="glyphicon glyphicon-search glyphicon-white"></span>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>