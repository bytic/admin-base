<?php

use ByTIC\Html\Dom\DomBuilder;

/** @var Stringable|string $content */
/** @var Stringable|string $title */
/** @var array $attributes */

$headerTools = $headerTools ?? [];
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