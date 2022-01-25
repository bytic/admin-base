<?php

namespace ByTIC\AdminBase\Tests\Screen\Actions\Collections;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Tests\AbstractTest;

/**
 *
 */
class ActionsCollectionTest extends AbstractTest
{
    public function test_key_by_name()
    {
        $collection = new ActionsCollection();

        $action = ButtonAction::make('test');
        $collection->add($action);

        self::assertTrue($collection->has('test'));
    }
}