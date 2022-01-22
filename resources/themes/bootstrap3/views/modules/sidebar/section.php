<?php
if (!function_exists('mvc_sections')) {
    return;
}
$module = request()->getModuleName();
$sections = mvc_sections()->visibleIn($module);
?>
<li class="nav-section">
    <h5 class="sidebar-header">
        <div class="btn-group btn-group-xs pull-right">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Change <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php foreach ($sections as $section) { ?>
                    <li>
                        <a href="<?php echo $section->getURL($url); ?>">
                            <?php echo $section->getName(); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <?php echo mvc_sections()->getCurrent()->getName() ?>
    </h5>
</li>