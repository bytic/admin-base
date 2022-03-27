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
    <?php if ($item->searchable()): ?>
        <li>
            <form class="px-2">
                <div class="">
                    <label>
                        <input type="email" class="form-control form-control-sm" placeholder="search" />
                    </label>
                </div>
            </form>
        </li>

        <li class="searchable-no-results" style="display: none">
            <span class="dropdown-item-text">
                No results
            </span>
        </li>
    <?php endif; ?>
    <?php foreach ($item->getMenu() as $item) { ?>
        <li class="menu-item">
            <?php $item->addHtmlClass('dropdown-item'); ?>
            <?= $this->load('/admin-actions/' . $item->getType(), ['item' => $item]); ?>
        </li>
    <?php } ?>
</ul>