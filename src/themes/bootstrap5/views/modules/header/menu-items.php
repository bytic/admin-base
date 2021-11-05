<?php
$menu = isset($menu) ? $menu : [];
$expanded = isset($expanded) ? $expanded : null;
?>

<?php foreach ($menu as $section => $item) { ?>
    <?php if ($item['enabled']) { ?>
        <?php
        $hasSubMenuString = is_string($item['submenus']) && !empty($item['submenus']);
        $hasSubMenu = $hasSubMenuString || count($item['submenus']) > 0;
        $sectionSelected = (isset($item['active']) && $item['active']) or ($section === $expanded);
        ?>
        <li class="nav-item <?php echo $sectionSelected ? ' active' : ''; ?><?php echo $hasSubMenu ? ' dropdown' : ''; ?>">
            <a href="<?php echo isset($item['href']) ? $item['href'] : 'javascript:'; ?>"
               class="nav-link <?php echo isset($item['class']) ? $item['class'] : ''; ?><?php echo $hasSubMenu ? 'dropdown-toggle' : ''; ?>"
                <?= $hasSubMenu ? 'role="button" data-bs-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ''; ?>
                <?= isset($item['attributes']) ? $this->HTML()->attributes($item['attributes']) : ''; ?>
            >

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

                <?php echo $item['name']; ?>
            </a>

            <?php if ($hasSubMenu) { ?>
                <ul class="dropdown-menu">
                    <?php if ($hasSubMenuString) {
                        echo $item['submenus'];
                        $item['submenus'] = [];
                    }
                    ?>

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