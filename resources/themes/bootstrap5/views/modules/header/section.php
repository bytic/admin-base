<?php

use ByTIC\Icons\Icons;
use function Nip\Router\route;

$sections = $this->get('sections') ?? false;
if (!$sections) {
    return;
}
?>

<ul class="navbar-nav navbar-sections">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-md-2 px-2" href="#" id="admin-sections" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <?= Icons::chevronCircleDown(); ?>
        </a>
        <div class="dropdown-menu dropdown-menu-md-end" aria-labelledby="admin-sections">
            <?php foreach ($sections as $section) { ?>
                <a class="dropdown-item" target="_blank"
                   href="<?= $section->getURL(route(request()->getModuleName())); ?>"
                >
                    <span class="section-icon"
                          style="<?php echo ($section->color) ? 'background-color:' . $section->color : ''; ?>">
                        <?= $section->printIcon(); ?>
                    </span>
                    <?= $section->getName(); ?>
                </a>
            <?php } ?>
        </div>
    </li>
</ul>