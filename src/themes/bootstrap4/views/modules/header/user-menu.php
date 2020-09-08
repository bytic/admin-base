<?php

$currentUser = $this->user;
$currentUserManager = $this->user->getManager();
?>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#userHeaderNavbar"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<!-- begin header-nav -->

<div class="collapse navbar-collapse" id="userHeaderNavbar">
    <ul class="navbar-nav ml-md-auto">
        <li class="nav-item dropdown navbar-user">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="icon-user icon-white"></i>
                <span class="d-none d-md-inline"><?php echo $this->user->getName(); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo $currentUserManager->compileURL('ChangePassword'); ?>"
                   class="dropdown-item"  target="_blank"
                   title="<?php echo $currentUserManager->getLabel('password.change'); ?>">
                    <?php echo $currentUserManager->getLabel('password.change'); ?>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo $currentUserManager->compileURL('Logout'); ?>"
                   title="Logout"
                   class="dropdown-item">
                    <i class="icon-off"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</div>