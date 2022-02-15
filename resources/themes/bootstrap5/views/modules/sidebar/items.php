<?php
/** @var array $menu */

use ByTIC\AdminBase\Utility\Icons;

$expanded = $expanded ?? null;
$selected = $selected ?? null;
?>
<?php foreach ($menu as $section => $item) { ?>
    <?php if (isset($item['enabled']) && $item['enabled'] === false) { ?>
        <?php continue; ?>
    <?php } ?>
    <?php $hasSubMenu = isset($item['submenus']) && is_array($item['submenus']) && (count($item['submenus']) > 0); ?>
    <?php $sectionSelected = (isset($item['active']) && $item['active']) or ($section === $expanded); ?>
    <li class="<?= $sectionSelected ? ' active' : ''; ?><?php echo $hasSubMenu ? ' has-sub' : ''; ?>">
        <a href="<?= $item['href'] ? $item['href'] : 'javascript:'; ?>"
           class="<?= $item['class'] ?? ''; ?>"
            <?= isset($item['attributes']) ? $this->HTML()->attributes($item['attributes']) : ''; ?>
        >
            <?php echo $hasSubMenu ? '<b class="caret pull-right"></b>' : ''; ?>

            <?= Icons::for($item['icon'] ?? ''); ?>
            <span class="sidebar-title"><?php echo $item['name']; ?></span>
        </a>

        <?php if ($hasSubMenu) { ?>
            <ul class="sub-menu" style="display:<?php echo $sectionSelected ? 'block' : 'none'; ?>;">
                <?php foreach ($item['submenus'] as $subsection => $sub) { ?>
                    <li <?php echo $subsection == $selected ? ' class="active"' : ''; ?>>
                        <a href="<?= $sub['href']; ?>"
                           title="<?= $sub['name']; ?>"
                            <?php echo isset($item['attributes']) ? $this->HTML()->attributes($sub['attributes']) : ''; ?>
                        >
                            <?php echo isset($sub['icon']) ? '<span class="glyphicon ' . $sub['icon'] . '"></span>' : ''; ?>
                            <?= $sub['name']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </li>
<?php } ?>  