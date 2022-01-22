<?php

use function Nip\Router\route;

$currentSection = mvc_sections()->getCurrent();
?>
<!-- begin #header -->
<header id="header" class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <?= $this->load('/modules/header/section'); ?>

        <a class="navbar-brand" href="<?php echo route(request()->getModuleName()); ?>">
            <span class="section-icon"
                  style="<?php echo ($currentSection->color) ? 'background-color:' . $currentSection->color : ''; ?>">
                <?php echo $currentSection->printIcon(); ?>
            </span>
            <?php echo config('app.name'); ?>
        </a>

        <button type="button" class="navbar-toggler" data-click="sidebar-toggled">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!-- end navbar-header -->

    <?= $this->load('/modules/header/toolbars'); ?>
</header>