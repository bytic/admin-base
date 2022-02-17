<?php

/** @var ActionsGroup $actionsGroup */

use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;
use ByTIC\Html\Html\HtmlBuilder;

$attributes = $actionsGroup->getHtmlAttributes();
$attributes['class'] .= ' action-toolbar navbar-nav';
$actions = $actionsGroup->actions();
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
