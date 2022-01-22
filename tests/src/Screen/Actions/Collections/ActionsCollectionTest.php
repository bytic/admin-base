<?php

namespace ByTIC\AdminBase\Tests\Screen\Actions\Collections;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Screen\Actions\Dto\BaseAction;
use ByTIC\AdminBase\Tests\AbstractTest;

/**
 *
 */
class ActionsCollectionTest extends AbstractTest
{
    public function test_key_by_name()
    {
        $collection = new ActionsCollection();

        $action = BaseAction::make('test');
        $collection->add($action);

        self::assertTrue($collection->has('test'));
    }
}