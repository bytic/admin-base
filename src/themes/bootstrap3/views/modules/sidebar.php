<?php
$menu = [];

$menu[] = [
    'name' => translator()->translate('dashboard'),
    'href' => $this->Url()->assemble('admin'),
    'icon' => 'glyphicon-home',
    'enabled' => true,
    'submenus' => [
    ]
];

?>


<div id="sidebar" class="">
    <ul class="nav nav-list">
        <li class="nav-header">
            <img src="<?php echo IMAGES_URL; ?>/logo-white.png" style="width:100%"/>
        </li>
        <?php echo $this->load(['/modules/sidebar/items', 'admin', 'common'],
            ['menu' => $menu, 'selected' => $selected]); ?>
    </ul>
</div>