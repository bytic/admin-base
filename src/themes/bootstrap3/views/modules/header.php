<?php

use Galantom\Organizations\Models\Users\Users;

?>
<div class="navbar navbar-fixed-top" role="navigation">
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->Url()->assemble('admin'); ?>">
                    <?php echo $this->_organization->getName(); ?>
                </a>
            </div>

            <ul class="nav pull-right">
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user glyphicon-white"></span>
                        <?php echo $this->user->getName(); ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Users::instance()->getChangePasswordURL(); ?>"
                               title="<?php echo Users::instance()->getLabel('password.change'); ?>">
                                <?php echo Users::instance()->getLabel('password.change'); ?>
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $this->Url()->assemble('admin.login.logout'); ?>" title="Logout"
                               class="">
                                <span class="glyphicon glyphicon-off"></span>
                                Logout
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>