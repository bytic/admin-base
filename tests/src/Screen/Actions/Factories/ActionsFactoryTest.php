<?php

namespace ByTIC\AdminBase\Tests\Screen\Actions\Factories;

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
}
