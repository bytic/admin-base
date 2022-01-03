<?php

namespace ByTIC\AdminBase\Tests\Actions\Collections;

use ByTIC\AdminBase\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Actions\Dto\BaseAction;
use ByTIC\AdminBase\Tests\AbstractTest;

/**
 *
 */
class ActionsCollectionTest extends AbstractTest
{
    public function test_key_by_name()
    {
        $collection = new ActionsCollection();
        $action = new BaseAction();
        $action->setName('test');
        $collection->add($action);

        self::assertTrue($collection->has('test'));
    }
}