<?php

/** @var ActionsGroup $actionsGroup */

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractParentAction;
use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;
use ByTIC\Html\Html\HtmlBuilder;

$attributes = $actionsGroup->getHtmlAttributes();
$attributes['class'] .= ' action-toolbar nav';
$actions = $actionsGroup->actions();
if (count($actions) < 1) {
    return;
}

$sidebarFallbackIcon = '<i class="fa fa-circle sidebar-fallback-icon" aria-hidden="true"></i>';
$ensureSidebarFallbackIcon = static function ($menuAction) use ($sidebarFallbackIcon): void {
    if (!is_object($menuAction) || !method_exists($menuAction, 'setIcon')) {
        return;
    }

    if (method_exists($menuAction, 'hasIcon') && $menuAction->hasIcon()) {
        return;
    }

    $menuAction->setIcon($sidebarFallbackIcon);
};
?>
<div <?= HtmlBuilder::buildAttributes($attributes) ?>>
    <h6 class="nav-header">
        <?= $actionsGroup->getTitle(); ?>
    </h6>

    <ul class="nav navbar-nav">
        <?php foreach ($actions as $action) { ?>
            <?php
            /** @var MenuItem $action */
            $hasSubMenu = $action instanceof AbstractParentAction && $action->hasChildren();
            $sectionSelected = $action->isSelected();
            $class = ['nav-item'];
            $ensureSidebarFallbackIcon($action);
            if ($hasSubMenu) {
                $class[] = 'has-sub';
                $action->addContentSuffix('<b class="caret"></b>');
            }
            if ($action instanceof DropdownAction) {
                $class[] = 'dropdown';
            }
            if ($sectionSelected) {
                $class[] = 'active';
            }
            ?>
            <li class="<?= implode(' ', $class) ?>">
                <?= $this->load('/admin-actions/' . $action->getType(), ['item' => $action]); ?>
                <?php if ($hasSubMenu) : ?>
                    <ul class="sub-menu" style="display:<?= $sectionSelected ? 'block' : 'none'; ?>;">
                        <?php foreach ($action->actions() as $sub) : ?>
                            <?php
                            $class = [];
                            $ensureSidebarFallbackIcon($sub);
                            if (method_exists($sub, 'isSelected') && $sub->isSelected()) {
                                $class[] = 'active';
                            }
                            ?>
                            <li class="<?= implode(' ', $class) ?>">
                                <?= $this->load('/admin-actions/' . $sub->getType(), ['item' => $sub]); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php } ?>
    </ul>
</div>
