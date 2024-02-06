<?php

use ByTIC\Icons\Icons;

if (!$this->existPath("/" . $this->controller . "/modules/filters")) {
    return;
}
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <?= translator()->trans('filters'); ?>
        </h4>
    </div>

    <div class="card-body">
        <form method="get" action="<?php echo $this->modelManager->getURL(); ?>" id="filter-form"
              class="filters">
            <div class="row">
                <?= $this->load("/" . $this->controller . "/modules/filters"); ?>

                <div class="col">
                    <button type="submit" class="btn btn-primary btn-large">
                        <?= Icons::search(); ?>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>