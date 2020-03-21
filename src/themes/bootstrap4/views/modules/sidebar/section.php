<?php
if (!class_exists('Sections')) {
    return;
}

$sections = Sections::instance()->getAll();
if (request()->getModuleName() == 'admin') {
    $url = $this->Url()->admin();
} else {
    $url = $this->Url()->organizers();
}

?>

<li class="nav-profile nav-section">
    <a href="javascript:;" data-toggle="nav-profile">
        <div class="info">
            <b class="caret pull-right"></b>John Smith
            <small>
                <?php echo Sections::instance()->getCurrent()->getName() ?>
            </small>
        </div>
    </a>
</li>

<li>
    <ul class="nav nav-profile">
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
</li>
