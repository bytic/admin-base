<?php


/** @var Stringable|string $content */

/** @var Stringable|string $title */

use ByTIC\Html\Html\HtmlBuilder;

$attributes = isset($attributes) ? $attributes->toArray() : [];
$headerTools = $headerTools ?? [];
$theme = $theme ?? '';
$themeMode = $themeMode ?? '';

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
$attributes_body['class'][] = 'card-body';

$wrapBody = $wrapBody ?? true;
if ($wrapBody) {
    $content = '<div ' . HtmlBuilder::buildAttributes($attributes_body) . '>' . $content . '</div>';
}
?>
<div <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <div class="card-header">
        <h4 class="card-title">
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
    <?= $content; ?>
</div>