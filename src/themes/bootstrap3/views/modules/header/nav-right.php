<?php
$usersManager = \Nip\Records\Locator\ModelLocator::get('users');
?>
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