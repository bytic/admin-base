<h3>Cards</h3>

<?php

use ByTIC\AdminBase\Widgets\Cards\Card;

$types = [
    '',
    'primary',
    'secondary',
    'success',
    'danger',
    'warning',
    'info',
    'light',
    'dark',
];
?>

<div class="row row-cols-4">

    <?php foreach ($types as $type): ?>
        <div class="col mb-4">
            <?= Card::make()
                ->withTheme($type)
                ->withTitle('Card ' . $type)
                ->withContent('Card content'); ?>
        </div>
    <?php endforeach; ?>
</div>
