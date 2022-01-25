<?php

use ByTIC\Html\Dom\DomBuilder;

/** @var Stringable|string $content */
/** @var Stringable|string $title */

$attributes = $attributes ?? [];
$headerTools = $headerTools ?? [];
$theme = $theme ?? '';
$themeMode = $themeMode ?? '';

$attributes['class'] = $attributes['class'] ?? '';
$attributes['class'] .= ' card';
$attributes['class'] = trim($attributes['class']);

$baseClass = 'card-';

if ($themeMode == 'full') {
    $baseClass = 'bg-';
}

if ($theme && $baseClass) {
    $attributes['class'] .= ' ' . $baseClass . $theme;
}

if ($themeMode == 'outline') {
    $attributes['class'] .= ' card-outline';
}

?>
<div<?= DomBuilder::buildAttributes($attributes) ?>>
    <div class="card-header">
        <h4 class="card-title">
            <?= $title ?>
        </h4>
        <?php if (count($headerTools)) : ?>
            <div class="box-tools">
                <?php foreach ($headerTools as $headerTool) : ?>
                    <?= $headerTool ?>
                <?php endforeach; ?>
            </div><!-- /.box-tools -->
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?= $content; ?>
    </div>
</div>