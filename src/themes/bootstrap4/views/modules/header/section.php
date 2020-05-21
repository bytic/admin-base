<?php
if (!class_exists('Sections')) {
    return;
}

$sections = Sections::instance()->getAll();
?>

<ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="admin-sections" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-th"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="admin-sections">

            <?php foreach ($sections as $section) { ?>
                <?php if ($section->organizers_switch === true) { ?>
                    <a class="dropdown-item" href="<?php echo $section->getURL(); ?>">
                        <?php echo $section->getName(); ?>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </li>
</ul>