<?php

/** @var ActionToolbar $toolbar */

use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\ActionToolbars\Dto\ActionToolbar;
use ByTIC\Html\Html\HtmlBuilder;

$attributes = $toolbar->getHtmlAttributes();
$attributes['class'] .= ' action-toolbar navbar-nav';
$actions = $toolbar->actions();
if (count($actions) < 1) {
    return;
}
?>
<ul <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <?php foreach ($actions as $action) { ?>
        <?php
        $class = ['nav-item'];
        if ($action instanceof DropdownAction) {
            $class[] = 'dropdown';
        }
        ?>
        <li class="<?= implode(' ', $class) ?>">
            <?= $this->load('/admin-actions/' . $action->getType(), ['item' => $action]); ?>
        </li>
    <?php } ?>
</ul>
