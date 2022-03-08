<?php

namespace ByTIC\AdminBase\Tests\Screen\Actions\Factories;

use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsFactory;
use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\Icons\Icons;

/**
 *
 */
class ActionsFactoryTest extends AbstractTest
{
    public function test_create_with_icon()
    {
        $action = ActionsFactory::fromArray([
            'name' => 'test',
            'icon' => Icons::plus(),
        ]);

        self::assertSame('<i class="fas fa-plus"></i>', $action->getIcon());
    }

    public function test_create_with_class()
    {
        $action = ActionsFactory::fromArray([
            'name' => 'test',
            'class' => 'class-test',
        ]);

        self::assertSame('class-test', (string)$action->getHtmlClassList());
    }

    public function test_create_with_submenu()
    {
        $action = ActionsFactory::fromArray([
            'name' => 'test',
            'icon' => Icons::plus(),
            'submenus' => [
                [
                    'name' => 'test-sub 1',
                    'icon' => Icons::plus(),
                ],
                [
                    'name' => 'test-sub 2',
                    'icon' => Icons::plus(),
                ]
            ],
        ]);

        self::assertInstanceOf(MenuItem::class, $action);
        self::assertTrue($action->hasChildren());
        self::assertCount(2, $action->actions());

        $sub1 = $action->actions()->current();
        self::assertSame('test-sub 1', $sub1->getName());
    }
}
