<?php

use ByTIC\Html\Dom\DomBuilder;

/** @var Stringable|string $content */
/** @var Stringable|string $title */
/** @var array $attributes */
?>
<div<?= DomBuilder::buildAttributes($attributes) ?>>
    <div class="card-header">
        <h4 class="card-title">
            <?= $title ?>
        </h4>
    </div>
    <div class="card-body">
        <?= $content; ?>
    </div>
</div>