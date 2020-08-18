<?php

use Nip\Records\Locator\ModelLocator;

$currentSection = mvc_sections()->getCurrent();
?>
<!-- begin #header -->
<header id="header" class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <?php echo $this->load('/modules/header/section'); ?>

        <a class="navbar-brand" href="<?php echo \Nip\Router\route(request()->getModuleName()); ?>">
            <span class="section-icon" style="<?php echo ($currentSection->color) ? 'background-color:'.$currentSection->color : ''; ?>">
                <?php echo $currentSection->printIcon(); ?>
            </span>
            <?php echo config('app.name'); ?>
        </a>

        <button type="button" class="navbar-toggler" data-click="sidebar-toggled">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!-- end navbar-header -->

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#userHeaderNavbar"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- begin header-nav -->

    <div class="collapse navbar-collapse" id="userHeaderNavbar">
        <ul class="navbar-nav ml-md-auto">
            <li class="dropdown navbar-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user icon-white"></i>
                    <span class="d-none d-md-inline"><?php echo $this->user->getName(); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?php echo ModelLocator::get('Administrators')->compileURL('ChangePassword'); ?>"
                       class="dropdown-item"
                       title="<?php echo ModelLocator::get('Users')->getLabel('password.change'); ?>">
                        <?php echo ModelLocator::get('Users')->getLabel('password.change'); ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo ModelLocator::get('Administrators')->compileURL('Logout'); ?>"
                       title="Logout"
                       class="dropdown-item">
                        <i class="icon-off"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>