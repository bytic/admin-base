<?php

$currentUser = $this->user;
$currentUserManager = $this->user->getManager();
?>


<ul class="navbar-nav">
    <li class="nav-item dropdown navbar-user">
        <a href="#" class="nav-link dropdown-toggle"
           data-toggle="dropdown" data-bs-toggle="dropdown">
            <i class="icon-user icon-white"></i>
            <span class="d-none d-md-inline"><?php echo $this->user->getName(); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
            <a href="<?php echo $currentUserManager->compileURL('ChangePassword'); ?>"
               class="dropdown-item" target="_blank"
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