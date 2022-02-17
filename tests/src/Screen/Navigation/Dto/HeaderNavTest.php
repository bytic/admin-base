<?php

namespace ByTIC\AdminBase\Tests\Screen\Navigation\Dto;

use ByTIC\AdminBase\Screen\Actions\Dto\LinkAction;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;
use ByTIC\AdminBase\Screen\Navigation\Dto\HeaderNav;
use ByTIC\AdminBase\Tests\AbstractTest;

/**
 *
 */
class HeaderNavTest extends AbstractTest
{
    public function test_addToolbarAction()
    {
        $testAction = LinkAction::make('test');

        $headerNav = new HeaderNav();
        $headerNav->addGroupAction($testAction, 'test');

        $toolbar = $headerNav->actionsGroup('test');
        self::assertInstanceOf(ActionsGroup::class, $toolbar);

        $actions = $toolbar->actions();
        self::assertCount(1, $actions);

        $action = $actions->current();
        self::assertInstanceOf(LinkAction::class, $action);
        self::assertSame($testAction, $action);
    }
}