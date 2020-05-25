<?php

$sections = isset($this->sections) ? $this->sections : false;
if (!$sections && class_exists('Sections')) {
    $sections = Sections::instance()->getAll();
}
if (!$sections) {
    return;
}

?>

<ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-item nav-link dropdown-toggle mr-md-2 px-2" href="#" id="admin-sections" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-th"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-md-left" aria-labelledby="admin-sections">

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