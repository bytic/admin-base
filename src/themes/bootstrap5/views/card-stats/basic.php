<?php
use ByTIC\Html\Tags\Anchor;

$title = $title ?? 'STAT';
$value = $value ?? '0';

$cardClasses = $cardClasses ?? null;
$icon = $icon ?? null;
$link = $link ?? null;
$variation = $variation ?? null;
$description = $description ?? null;
?>

<div class="card card-stats mb-4 mb-xl-0 <?= $cardClasses; ?>">
    <div class="card-header">
        <h5 class="card-title">
            <?php echo $title; ?>
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <span class="h2 font-weight-bold mb-0">
                    <?= $link ? Anchor::url($link, $value) : $value; ?>
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
