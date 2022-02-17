<?php

use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use ByTIC\AdminBase\Screen\Layouts\Dto\BaseLayout;

$layout = new BaseLayout();

$sidebar = $layout->sidebarNav();

$sidebar->addGroupAction(
    MenuItem::make('cards')
        ->setLabel('Cards')
        ->setUrl('?controller=cards')
);
return $layout;
