<?php
$menu = isset($menu) ? $menu : [];
?>
<div class="collapse navbar-collapse" id="">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <?php echo $this->load('/modules/header/menu-items', ['menu' => $menu]); ?>
    </ul>
</div>