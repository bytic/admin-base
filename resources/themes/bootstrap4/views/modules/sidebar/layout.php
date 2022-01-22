<?php
$menu = isset($menu) ? $menu : [];
$selected = isset($selected) ? $selected : null;

?>
<div id="sidebar" class="sidebar">
    <?php echo $this->load('sidebar-minify'); ?>

    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <?php echo $this->load('header'); ?>
            <!--            --><?php ////echo $this->load('section'); ?>
        </ul>
        <ul class="nav nav-list">
            <?php echo $this->load('items', ['menu' => $menu, 'selected' => $selected]); ?>
        </ul>
    </div>
</div>

<div id="sidebar-bg"></div>