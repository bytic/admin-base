<?php

/** @var ActionsGroup $actionsGroup */

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractParentAction;
use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;
use ByTIC\Html\Html\HtmlBuilder;
use ByTIC\Icons\Icons;

$attributes = $actionsGroup->getHtmlAttributes();
$attributes['class'] .= ' action-toolbar nav';
$actions = $actionsGroup->actions();
if (count($actions) < 1) {
    return;
}
?>
<div <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <h6 class="nav-header">
        <?= $actionsGroup->getTitle(); ?>
    </h6>

    <ul class="nav navbar-nav">
        <?php foreach ($actions as $action) { ?>
            <?php
            $hasSubMenu = $action instanceof AbstractParentAction && $action->hasChildren();
            $sectionSelected = false;
            $class = ['nav-item'];
            if (false == $action->hasIcon()) {
                $action->setIcon(Icons::bookmark());
            }
            if ($hasSubMenu) {
                $class[] = 'has-sub';
                $action->setIcon('<b class="caret pull-right"></b>' . $action->getIcon());
            }
            if ($action instanceof DropdownAction) {
                $class[] = 'dropdown';
            }
            ?>
            <li class="<?= implode(' ', $class) ?>">
                <?= $this->load('/admin-actions/' . $action->getType(), ['item' => $action]); ?>
                <?php if ($hasSubMenu) : ?>
                    <ul class="sub-menu" style="display:<?= $sectionSelected ? 'block' : 'none'; ?>;">
                        <?php foreach ($action->actions() as $sub) : ?>
                            <li>
                                <?= $this->load('/admin-actions/' . $sub->getType(), ['item' => $sub]); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php } ?>
    </ul>
</div>
