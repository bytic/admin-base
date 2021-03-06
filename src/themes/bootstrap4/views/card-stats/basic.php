<?php
$title = isset($title) ? $title : 'STAT';
$value = isset($value) ? $value : '0';

$icon = isset($icon) ? $icon : null;
$variation = isset($variation) ? $variation : null;
$description = isset($description) ? $description : null;
?>

<div class="card card-stats mb-4 mb-xl-0">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">
                    <?php echo $title; ?>
                </h5>
                <span class="h2 font-weight-bold mb-0">
                    <?php echo $value; ?>
                </span>
            </div>
            <?php if ($icon) { ?>
                <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($description) { ?>
        <p class="mt-3 mb-0 text-muted text-sm">
            <?php if ($variation) { ?>
                <span class="text-success mr-2">
                    <i class="fa fa-arrow-up"></i>
                    <?php echo $variation; ?>%
                </span>
            <?php } ?>
            <span class="text-nowrap">
                <?php echo $description; ?>
            </span>
        </p>
        <?php } ?>
    </div>
</div>
