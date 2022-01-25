<?php

namespace ByTIC\AdminBase\Tests\Screen\Actions\Dto;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Widgets\Cards\Card;

/**
 *
 */
class ButtonActionTest extends AbstractTest
{
    public function test_basic()
    {
        $item = $this->basicButton();

        self::assertXmlStringEqualsXmlFile(
            TEST_FIXTURE_PATH . '/Screen/Actions/Dto/basic.html',
            (string)$item
        );
    }

    /**
     * @return HasContent|HasTitle|Card
     */
    protected function basicButton()
    {
        return ButtonAction::make()
            ->setLabel('My Title')
            ->setUrl('/my-url');
    }
}