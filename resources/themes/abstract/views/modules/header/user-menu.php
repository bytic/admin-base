<?php

$currentUser = $this->get('user');
if (false === is_object($currentUser)) {
    return;
}
$currentUserManager = $currentUser->getManager();
?>

<ul class="navbar-nav me-0">
    <li class="nav-item dropdown navbar-user">
        <a href="#" class="nav-link dropdown-toggle"
           data-toggle="dropdown" data-bs-toggle="dropdown">
            <i class="icon-user icon-white"></i>
            <span class="d-none d-md-inline">
                <?= $currentUser->getName(); ?>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
            <a href="<?= $currentUserManager->compileURL('ChangePassword'); ?>"
               class="dropdown-item" target="_blank"
               title="<?= $currentUserManager->getLabel('password.change'); ?>">
                <?= $currentUserManager->getLabel('password.change'); ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= $currentUserManager->compileURL('Logout'); ?>"
               title="Logout"
               class="dropdown-item">
                <i class="icon-off"></i>
                Logout
            </a>
        </div>
    </li>
</ul>