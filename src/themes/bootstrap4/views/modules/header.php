<?php

use Nip\Records\Locator\ModelLocator;

?>
<!-- begin #header -->
<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="<?php echo $this->Url()->admin(); ?>">
            <?php echo config('app.name'); ?>
        </a>
    </div>
    <!-- end navbar-header -->

    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
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