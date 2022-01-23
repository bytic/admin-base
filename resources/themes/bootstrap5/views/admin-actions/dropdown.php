<?php

use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Utility\HtmlElements;
use ByTIC\Html\Tags\Anchor;

/** @var DropdownAction $item */
$attributes = HtmlElements::attributesForAction($item);
$content = HtmlElements::contentForAction($item);

$attributes['class'] = implode(' ', [$attributes['class'], 'nav-link dropdown-toggle']);
$attributes['role'] = 'button';
$attributes['data-bs-toggle'] = 'dropdown';
$attributes['aria-expanded'] = 'false';
?>

<?= Anchor::url($item->getUrl(), $content, $attributes) ?>

<ul class="dropdown-menu">
    <?php foreach ($item->getMenu() as $item) { ?>
        <li>
            <?php $item->addClass('dropdown-item'); ?>
            <?= $this->load('/admin-actions/' . $item->getType(), ['item' => $item]); ?>
        </li>
    <?php } ?>
</ul>