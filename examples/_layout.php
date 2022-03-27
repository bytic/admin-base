<?php

use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\Actions\Dto\LinkAction;
use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use ByTIC\AdminBase\Screen\Layouts\Dto\BaseLayout;
use ByTIC\Icons\Icons;

$layout = new BaseLayout();

$actionsGroupLeft = $layout->headerNav()->actionsGroup('left');
$actionsGroupLeft->addHtmlClass('me-auto');

$organizationsDropdown = DropdownAction::make('help')
    ->setLabel('Help')
    ->withIcon(Icons::questionCircle())
    ->addMenuItem(
        LinkAction::make('main1')->setLabel('Item 1')
    )
    ->addMenuItem(
        LinkAction::make('main2')->setLabel('Item 2')
    )
    ->addMenuItem(
        LinkAction::make('main3')->setLabel('Item 3')
    );
$organizationsDropdown->searchable(true);
$actionsGroupLeft->addAction($organizationsDropdown);

$sidebar = $layout->sidebarNav();

$sidebar->addGroupAction(
    MenuItem::make('cards')
        ->setLabel('Cards')
        ->setUrl('?controller=cards')
);
return $layout;
