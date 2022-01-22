<?php

use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\Html\Tags\Anchor;

/** @var DropdownAction $item */
$attributes = $item->getHtmlAttributes();
$attributes['title'] = $item->getLabel();
$label = implode(' ', [$item->getIcon(), $item->getLabel()]);
$attributes['class'] = implode(' ', [$attributes['class'], 'nav-link dropdown-toggle']);

$attributes['role'] = 'button';
$attributes['data-bs-toggle'] = 'dropdown';
$attributes['aria-expanded'] = 'false';
?>

<?= Anchor::url($item->getUrl(), $label, $attributes) ?>

<ul class="dropdown-menu">
    <?php foreach ($item->getMenu() as $item) { ?>
        <li>
            <?php $item->setCssClass('dropdown-item'); ?>
            <?= $this->load('/admin-actions/' . $item->getType(), ['item' => $item]); ?>
        </li>
    <?php } ?>
</ul>