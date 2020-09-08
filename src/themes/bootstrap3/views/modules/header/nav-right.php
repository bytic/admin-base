<?php
$currentUserManager = $this->user->getManager();
$usersManager = \Nip\Records\Locator\ModelLocator::get('users');
?>
<ul class="navbar-nav nav pull-right">
    <li class="divider-vertical"></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user glyphicon-white"></span>
            <?php echo $this->user->getName(); ?>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo $currentUserManager->compileURL('ChangePassword'); ?>" target="_blank"
                   title="<?php echo $usersManager->getLabel('password.change'); ?>">
                    <?php echo $usersManager->getLabel('password.change'); ?>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo $currentUserManager->compileURL('Logout'); ?>" title="Logout"
                   class="">
                    <span class="glyphicon glyphicon-off"></span>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul>