<?php

/** @var Stringable|string $content */
/** @var Stringable|string $title */
/** @var Stringable|string|null $footer */

/** @var Stringable|string $icon */

use ByTIC\Html\Html\HtmlBuilder;

$attributes = isset($attributes) ? $attributes->toArray() : [];
$headerTools = $headerTools ?? [];
$theme = $theme ?? '';
$themeMode = $themeMode ?? '';

$cardId = $attributes['id'] ?? 'card-' . uniqid();
$attributes['class'] = $attributes['class'] ?? [];
$attributes['class'][] = 'card';

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

$footer = $footer ?? null;
$hasFooter = !empty($footer) || $footer === '0';
$attributes_footer = isset($attributes_footer) ? $attributes_footer->toArray() : [];
if ($hasFooter) {
    $attributes_footer['class'] = $attributes_footer['class'] ?? [];
    $attributes_footer['class'][] = 'card-footer';
}
?>
<div <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <div class="card-header">
        <h4 class="card-title">
            <?= $icon ?>
            <?= $title ?>
        </h4>
        <?php if (count($headerTools)) : ?>
            <div class="box-tools">
                <?php foreach ($headerTools as $headerTool) : ?>
                    <?= $headerTool ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div id="<?= $cardId . '-content'; ?>" <?= HtmlBuilder::buildAttributes($attributes_body) ?>>
        <?= $content; ?>
    </div>
    <?php if ($hasFooter) : ?>
        <div <?= HtmlBuilder::buildAttributes($attributes_footer) ?>>
            <?= $footer; ?>
        </div>
    <?php endif; ?>
</div>