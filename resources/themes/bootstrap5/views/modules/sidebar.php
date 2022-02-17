<?php

/** @var SidebarNav $sidebarNav */

use ByTIC\AdminBase\Screen\Navigation\Dto\SidebarNav;
use ByTIC\AdminBase\Utility\ViewHelper;

$sidebarNav = $this->get(ViewHelper::VIEW_VAR_LAYOUT);
$actionsGroups = $sidebarNav->actionsGroups();
?>
<?= $this->load(
    '/modules/sidebar/layout',
    ['actionsGroups' => $actionsGroups]
); ?>