<?php

/** @var ActionToolbar $toolbar */

use ByTIC\AdminBase\Screen\ActionToolbars\Dto\ActionToolbar;

$actions = $toolbar->actions();
if (count($actions) < 1) {
    return;
}
?>
<ul class="action-toolbar navbar-nav">
    <?php foreach ($actions as $action) { ?>
        <li class="nav-item">
            <?= $this->load('/admin-actions/' . $action->getType(), ['item' => $action]); ?>
        </li>
    <?php } ?>
</ul>
