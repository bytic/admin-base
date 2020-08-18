<?php

$sections = isset($this->sections) ? $this->sections : false;
if (!$sections) {
    return;
}

?>

<ul class="navbar-nav navbar-sections">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-md-2 px-2" href="#" id="admin-sections" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-th"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md-left" aria-labelledby="admin-sections">
            <?php foreach ($sections as $section) { ?>
                <a class="dropdown-item" target="_blank"
                   href="<?php echo $section->getURL(\Nip\Router\route(request()->getModuleName())); ?>"
                >
                    <span class="section-icon" style="<?php echo ($section->color) ? 'background-color:'.$section->color : ''; ?>">
                        <?php echo $section->printIcon(); ?>
                    </span>
                    <?php echo $section->getName(); ?>
                </a>
            <?php } ?>
        </div>
    </li>
</ul>