<?php
if ($selected) {
    if (strpos($selected, ".") !== false) {
        list($expanded, $selected) = explode(".", $selected);
    } else {
        $expanded = $selected;
    }
}

?>
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <?php echo $this->load('header'); ?>
            <?php echo $this->load('section'); ?>
        </ul>
        <ul class="nav nav-list">
            <?php echo $this->load('items', ['menu' => $menu]); ?>
        </ul>
    </div>
</div>

<div id="sidebar-bg"></div>