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
$attributes['class'][] = 'card-stats';
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
    <div id="<?= $cardId . '-content'; ?>" <?= HtmlBuilder::buildAttributes($attributes_body) ?>>
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1">
                <p class="text-uppercase fw-semibold text-muted small mb-1">
                    <a href="<?= $data->get('url', '#'); ?>" class="text-decoration-none link-secondary">
                        <?= $title ?>
                    </a>
                </p>
                <h3 class="fw-bold mb-0"><?= $data->get('value'); ?></h3>
            </div>
            <?php if ($icon) { ?>
                <div class="rounded-3 p-3 text-<?= $theme ?: 'primary' ?>" style="background-color: rgba(var(--bs-<?= $theme ?: 'primary' ?>-rgb), .1);">
                    <?= $icon ?>
                </div>
            <?php } ?>
        </div>
        <?php if ($percentage || $valueHelp) { ?>
            <div class="d-flex align-items-center gap-2 mt-3">
                <?php if ($percentage) { ?>
                    <span class="badge rounded-pill text-bg-<?= $percentage > 0 ? 'success' : 'danger'; ?>">
                        <i class="fa fa-arrow-<?= $percentage > 0 ? 'up' : 'down'; ?>"></i>
                        <?= $percentage; ?>%
                    </span>
                <?php } ?>
                <?php if ($valueHelp) { ?>
                    <small class="text-muted"><?= $valueHelp ?></small>
                <?php } ?>
            </div>
        <?php } ?>
        <?= $content; ?>
    </div>
</div>