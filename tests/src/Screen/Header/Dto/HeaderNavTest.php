<?php

namespace ByTIC\AdminBase\Tests\Screen\Header\Dto;

use ByTIC\AdminBase\Screen\Actions\Dto\LinkAction;
use ByTIC\AdminBase\Screen\ActionToolbars\Dto\ActionToolbar;
use ByTIC\AdminBase\Screen\Header\Dto\HeaderNav;
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
        $headerNav->addToolbarAction($testAction, 'test');

        $toolbar = $headerNav->getToolbar('test');
        self::assertInstanceOf(ActionToolbar::class, $toolbar);

        $actions = $toolbar->actions();
        self::assertCount(1, $actions);

        $action = $actions->current();
        self::assertInstanceOf(LinkAction::class, $action);
        self::assertSame($testAction, $action);
    }
}