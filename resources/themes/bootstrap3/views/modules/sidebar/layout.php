<?php
if ($selected) {
    if (strpos($selected, ".") !== false) {
        list($expanded, $selected) = explode(".", $selected);
    } else {
        $expanded = $selected;
    }
}

?>
<div id="sidebar" class="">
    <ul class="nav nav-list">
        <?php echo $this->load('header'); ?>
        <?php echo $this->load('section'); ?>
        <?php echo $this->load('items', ['menu' => $menu]); ?>
    </ul>
</div>

<div id="sidebar-bg"></div>