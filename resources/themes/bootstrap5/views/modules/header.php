<?php

use ByTIC\AdminBase\Screen\Layouts\Dto\BaseLayout;
use function Nip\Router\route;

/** @var BaseLayout $layout */
$layout = $this->get('_adminBaseLayout');
$currentSection = $layout->branding()->getSection();
$branding = $layout->branding();
$baseUrl = function_exists('Nip\Router\route') && function_exists('request') ? route(request()->getModuleName()) : '#';
?>
<!-- begin #header -->
<header id="header" class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- begin navbar-header -->
    <div class="navbar-header">

        <a class="navbar-brand btn btn-flat btn-info" href="<?= $baseUrl; ?>">
            <?php if ($currentSection) : ?>
                <span class="section-icon"
                      style="<?= ($currentSection->color) ? 'background-color:' . $currentSection->color : ''; ?>">
                <?= $currentSection->printIcon(); ?>
            </span>
            <?php endif; ?>
            <?= $branding->getName(); ?>
        </a>

        <?= $this->load('/modules/header/section'); ?>

        <button type="button" class="navbar-toggler" data-click="sidebar-toggled">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!-- end navbar-header -->

    <?= $this->load('/modules/header/toolbars'); ?>
</header>