<?php
$expanded = isset($expanded) ? $expanded : null;
$selected = isset($selected) ? $selected : null;
?>
<?php foreach ($menu as $section => $item) { ?>
    <?php if ($item['enabled']) { ?>
        <?php $hasSubMenu = count($item['submenus']) > 0; ?>
        <?php $sectionSelected = (isset($item['active']) && $item['active']) or ($section === $expanded); ?>
        <li class="<?php echo $sectionSelected ? ' active' : ''; ?><?php echo $hasSubMenu ? ' has-sub' : ''; ?>">
            <a href="<?php echo $item['href'] ? $item['href'] : 'javascript:'; ?>"
               class="<?php echo isset($item['class']) ? $item['class'] : ''; ?>"
                <?php echo isset($item['attributes']) ? $this->HTML()->attributes($item['attributes']) : ''; ?>
            >
                <?php echo $hasSubMenu ? '<b class="caret pull-right"></b>' : ''; ?>

                <?php
                if (isset($item['icon']) && !empty($item['icon'])) {
                    $iconType = false;
                    if (strpos($item['icon'], 'glyphicon') === 0) {
                        $iconType = 'glyphicon';
                    } elseif (strpos($item['icon'], 'fa-') === 0) {
                        $iconType = 'fa';
                    }
                    $classPrefix = '';
                    switch ($iconType) {
                        case 'glyphicon':
                            $classPrefix = 'glyphicon';
                            break;
                        case 'fa':
                            $classPrefix = 'fa';
                            break;
                    }
                    echo '<i class="' . $classPrefix . ' ' . $item['icon'] . ($sectionSelected ? ' glyphglyphicon-white' : '') . '"></i>';
                } else {
                    echo '<i class="fa fa-th-large"></i>';
                }
                ?>

                <span class="sidebar-title"><?php echo $item['name']; ?></span>
            </a>

            <?php if ($hasSubMenu) { ?>
                <ul class="sub-menu" style="display:<?php echo $sectionSelected ? 'block' : 'none'; ?>;">
                    <?php foreach ($item['submenus'] as $subsection => $sub) { ?>
                        <li <?php echo $subsection == $selected ? ' class="active"' : ''; ?>>
                            <a href="<?php echo $sub['href']; ?>"
                               title="<?php echo $sub['name']; ?>"
                                <?php echo isset($item['attributes']) ? $this->HTML()->attributes($sub['attributes']) : ''; ?>
                            >
                                <?php echo isset($sub['icon']) ? '<span class="glyphicon ' . $sub['icon'] . '"></span>' : ''; ?>
                                <?php echo $sub['name']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
    <?php } ?>
<?php } ?>  