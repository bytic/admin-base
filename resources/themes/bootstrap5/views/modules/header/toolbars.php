<?php

use ByTIC\AdminBase\Screen\Navigation\Dto\HeaderNav;

?>
<?= $this->loadIfExists('/modules/header/menu'); ?>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-toolbars"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- begin header-nav -->
<div class="collapse navbar-collapse" id="header-toolbars">
    <?php
    /** @var HeaderNav $headerNav */
    $headerNav = $this->_adminBaseHeaderNav;

    $actionsGroups = $headerNav->actionsGroups();
    foreach ($actionsGroups as $actionsGroup) {
        echo $this->load('/admin-action-groups/navbar', ['actionsGroup' => $actionsGroup]);
    }
    ?>

    <?= $this->loadIfExists('/modules/header/user-menu'); ?>
</div>
        