<?php

use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Screen\Navigation\Dto\SidebarNav;
use ByTIC\AdminBase\Utility\ViewHelper;

if (!isset($actionsGroups)) {
    /** @var SidebarNav $sidebarNav */
    $sidebarNav = $this->get(ViewHelper::VIEW_VAR_SIDEBAR);
    $actionsGroups = $sidebarNav->actionsGroups();
}

$menu = $menu ?? [];
if (count($menu) > 0) {
    $actions = ActionsCollectionsFactory::fromArray($menu);
    foreach ($actions as $action) {
        $actionsGroups->addGroupAction($action);
    }
}
$selected = $selected ?? null;

?>
<div id="sidebar" class="sidebar">
    <?php echo $this->load('sidebar-minify'); ?>

    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <?php echo $this->load('header'); ?>
        </ul>

        <!-- begin sidebar search -->
        <div class="sidebar-search">
            <div class="sidebar-search-input">
                <i class="fa fa-search sidebar-search-icon"></i>
                <input type="text"
                       class="form-control"
                       placeholder="Search menu..."
                       data-sidebar-search="true"
                       autocomplete="off"
                       aria-label="Search menu">
                <button type="button" class="sidebar-search-clear d-none" aria-label="Clear search">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <!-- end sidebar search -->

        <?php
        foreach ($actionsGroups as $actionsGroup) {
            echo $this->load('/admin-action-groups/sidebar', ['actionsGroup' => $actionsGroup]);
        }
        ?>
        <ul class="nav nav-list">
            <?php //echo $this->load('items', ['menu' => $menu, 'selected' => $selected]); ?>
        </ul>
    </div>
</div>

<div id="sidebar-bg"></div>