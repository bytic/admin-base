<?php
if (!class_exists('Sections')) {
    return;
}
?>
<li class="nav-section">
    <h5 class="sidebar-header">
        <div class="btn-group btn-group-xs pull-right">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Change <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php
                $sections = Sections::instance()->getAll();
                if (\Nip\Request::instance()->getModuleName() == 'admin') {
                    $url = $this->Url()->admin();
                } else {
                    $url = $this->Url()->organizers();
                }
                ?>
                <?php foreach ($sections as $section) { ?>
                    <?php if ($section->organizers_switch === true) { ?>
                        <li>
                            <a href="<?php echo $section->getURL($url); ?>">
                                <?php echo $section->getName(); ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>

        <?php echo Sections::instance()->getCurrent()->getName() ?>
    </h5>
</li>