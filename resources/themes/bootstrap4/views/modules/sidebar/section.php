<?php
if (!function_exists('mvc_sections')) {
    return;
}
$module = request()->getModuleName();
$sections = mvc_sections()->visibleIn($module);

if ($module == 'admin') {
    $url = $this->Url()->admin();
} else {
    $url = $this->Url()->organizers();
}

?>

<li class="nav-profile nav-section">
    <a href="javascript:" data-toggle="nav-profile">
        <div class="info">
            <b class="caret pull-right"></b>John Smith
            <small>
                <?php echo mvc_sections()->getCurrent()->getName() ?>
            </small>
        </div>
    </a>
</li>

<li>
    <ul class="nav nav-profile">
        <?php foreach ($sections as $section) { ?>
            <li>
                <a href="<?php echo $section->getURL($url); ?>">
                    <?php echo $section->getName(); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</li>
