<?php

use function Nip\Router\route;

$sections = isset($this->sections) ? $this->sections : false;
if (!$sections) {
    return;
}

?>

<ul class="navbar-nav nav navbar-sections">
    <li class="dropdown">
        <a class="nav-link dropdown-toggle mr-md-2 px-2" href="#" id="admin-sections" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-th"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-md-left" aria-labelledby="admin-sections">
            <?php foreach ($sections as $section) { ?>
                <li>
                    <a class="dropdown-item" target="_blank"
                       href="<?php echo $section->getURL(route(request()->getModuleName())); ?>"
                    >
                        <span class="section-icon"
                              style="<?php echo ($section->color) ? 'background-color:' . $section->color : ''; ?>">
                            <?php echo $section->printIcon(); ?>
                        </span>
                        <?php echo $section->getName(); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </li>
</ul>