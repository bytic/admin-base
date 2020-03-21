<?php

use Nip\Records\Locator\ModelLocator;

?>
<div id="header" class="header navbar navbar-default navbar-light fixed-top">
    <!-- begin mobile sidebar expand / collapse button -->
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo $this->Url()->admin(); ?>">
            <?php echo config('app.name'); ?>
        </a>

        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- end mobile sidebar expand / collapse button -->

    <!-- begin header navigation right -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" id="headerNavbarUserDropdown"
               data-toggle="dropdown" aria-expanded="false">
                <i class="icon-user icon-white"></i>
                <span class="d-none d-md-inline"><?php echo $this->user->getName(); ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="headerNavbarUserDropdown">
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