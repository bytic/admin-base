<?php

/** @var Stringable|string $content */
/** @var Stringable|string $title */

/** @var Stringable|string $icon */

use ByTIC\AdminBase\Widgets\Cards\CardStats;
use ByTIC\Html\Html\HtmlBuilder;
use Nip\Collections\Collection;

$attributes = isset($attributes) ? $attributes->toArray() : [];
$headerTools = $headerTools ?? [];
$theme = $theme ?? '';
$themeMode = $themeMode ?? '';

/** @var Collection $data */
$data = $data ?? [];

$cardId = $attributes['id'] ?? 'card-' . uniqid();
$attributes['class'] = $attributes['class'] ?? [];
$attributes['class'][] = 'card';
if ($theme) {
    $attributes['class'][] = 'border-' . $theme;
}

$baseClass = 'card-';

if ($themeMode == 'full') {
    $baseClass = 'bg-';
}

if ($theme && $baseClass) {
    $attributes['class'][] = $baseClass . $theme;
}

if ($themeMode == 'outline') {
    $attributes['class'][] = 'card-outline';
}

$attributes_body = isset($attributes_body) ? $attributes_body->toArray() : [];
$wrapBody = $wrapBody ?? true;
if ($wrapBody) {
    $attributes_body['class'][] = 'card-body';
}
$percentage = $data->get(CardStats::DATA_VARIATION, false);
$percentage = is_float($percentage) ? round($percentage, 2) : $percentage;

$valueHelp = $data->get(CardStats::DATA_VALUE_HELP, false);
?>
<div <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <div class="card-header">

    </div>
    <div id="<?= $cardId . '-content'; ?>" <?= HtmlBuilder::buildAttributes($attributes_body) ?>>
        <?php if ($icon) { ?>
            <div class="float-end badge fs-6 p-3 text-bg-<?= $theme ?>" style="--bs-bg-opacity: .3;">
                <?= $icon ?>
            </div>
        <?php } ?>
        <h6 class="card-subtitle text-uppercase fw-bold">
            <a href="<?= $data->get('url', '#'); ?>">
                <?= $title ?>
            </a>
        </h6>
        <div class="d-flex gap-2">
            <h3 class="fw-bold py-1 m-0 fs-1">
            <span class="value">
                <?= $data->get('value'); ?>
            </span>
            </h3>
            <?php if ($percentage) { ?>
                <div style="">
                    <span class="d-inline text-nowrap badge fs-6 bg-<?= $percentage > 0 ? 'success' : 'danger'; ?> "
                          style="--bs-bg-opacity: .5;">
                        <small>

                        <i class="fa fa-arrow-<?= $percentage > 0 ? 'up' : 'down'; ?>"></i>
                        <?= $percentage; ?>%
                        </small>
                    </span>
                </div>
            <?php } ?>
        </div>
        <?php if ($valueHelp) { ?>
                <div>
                    <small class="text-muted">
                        <?= $valueHelp ?>
                    </small>
                </div>
        <?php } ?>
        <?= $content; ?>
    </div>
</div>