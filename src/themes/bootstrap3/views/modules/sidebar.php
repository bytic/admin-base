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

$manager = Fundraising_Pages::instance();
$menu[$manager->getController()] = [
    'name' => $manager->getLabel("title"),
    'href' => $manager->getURL(),
    'icon' => 'glyphicon-file',
    'enabled' => true,
    'submenus' => [
        "list" => [
            'name' => $manager->getLabel("title"),
            'href' => $manager->getURL(),
            'icon' => 'glyphicon-plus',
        ],
//        "add" => [
//            'name' => $manager->getLabel("add"),
//            'href' => $manager->compileURL('add'),
//            'icon' => 'glyphicon-plus',
//        ]
    ]
];

$manager = \Galantom\Birthday\Models\FundraisingPages\FundraisingPages::instance();
$menu[$manager->getController()] = [
    'name' => $manager->getLabel("title"),
    'href' => $manager->getURL(),
    'icon' => 'glyphicon-book',
    'enabled' => true,
    'submenus' => [
        "report" => [
            'name' => translator()->trans('report'),
            'href' => $manager->compileURL('report'),
            'icon' => 'glyphicon-plus',
        ]
    ]
];

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
        <li class="nav-header">
            <img src="<?php echo IMAGES_URL; ?>/logo-white.png" style="width:100%"/>
        </li>
        <?php echo $this->load(['/modules/sidebar/items', 'admin', 'common'],
            ['menu' => $menu, 'selected' => $selected]); ?>
    </ul>
</div>