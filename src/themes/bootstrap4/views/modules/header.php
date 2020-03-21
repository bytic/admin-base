<?php

use Nip\Records\Locator\ModelLocator;

?>
<div id="header" class="header navbar navbar-default navbar-light fixed-top">
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggler collapsed navbar-toggle-left" data-click="sidebar-minify">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button type="button" class="navbar-toggler" data-click="sidebar-toggled">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->Url()->admin(); ?>">
                <?php echo config('app.name'); ?>
            </a>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="headerNavbarUserDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-user icon-white"></i>
                    <?php echo $this->user->getName(); ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" aria-labelledby="headerNavbarUserDropdown">
                    <li class="dropdown-item">
                        <a href="<?php echo ModelLocator::get('Administrators')->compileURL('ChangePassword'); ?>"
                           title="<?php echo ModelLocator::get('Users')->getLabel('password.change'); ?>">
                            <?php echo ModelLocator::get('Users')->getLabel('password.change'); ?>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown-item">
                        <a href="<?php echo ModelLocator::get('Administrators')->compileURL('Logout'); ?>"
                           title="Logout"
                           class="">
                            <i class="icon-off"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>