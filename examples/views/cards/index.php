<h3>Cards</h3>

<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\AdminBase\Widgets\Cards\CardStats;
use ByTIC\Icons\Icons;

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

<h3>Card Stats</h3>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
    <div class="col">
        <?= CardStats::make()
            ->setId('stat-revenue')
            ->withTitle('Total Revenue')
            ->withIcon(Icons::moneyBillWave())
            ->setValue('$48,295')
            ->setVariation(12.5)
            ->setValueHelp('vs last month')
            ->themeSuccess(); ?>
    </div>
    <div class="col">
        <?= CardStats::make()
            ->setId('stat-orders')
            ->withTitle('New Orders')
            ->withIcon(Icons::receipt())
            ->setValue('1,284')
            ->setVariation(-3.2)
            ->setValueHelp('vs last month')
            ->themeDanger(); ?>
    </div>
    <div class="col">
        <?= CardStats::make()
            ->setId('stat-users')
            ->withTitle('Active Users')
            ->withIcon(Icons::userFriends())
            ->setValue('8,942')
            ->setVariation(0)
            ->setValueHelp('no change')
            ->themeInfo(); ?>
    </div>
    <div class="col">
        <?= CardStats::make()
            ->setId('stat-conversion')
            ->withTitle('Conversion Rate')
            ->withIcon(Icons::chartBar())
            ->setValue('3.6%')
            ->setValueHelp('all time average')
            ->themeWarning(); ?>
    </div>
</div>
