<?php

namespace ByTIC\AdminBase\Tests\Widgets\Cards;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;

/**
 *
 */
class CardTest extends AbstractTest
{
    public function test_basic()
    {
        $card = $this->basicCard();

        self::assertXmlStringEqualsXmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/basic.html',
            (string)$card
        );
    }

    public function test_basic_tools()
    {
        $card = $this->basicCard();
        $card->addHeaderTool(
            ButtonAction::make()
                ->setLabel('My Button')
                ->withIcon(Icons::star())
        );
        self::assertXmlStringEqualsXmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/basic_tools.html',
            (string)$card
        );
    }

    /**
     * @return HasContent|HasTitle|Card
     */
    protected function basicCard()
    {
        return Card::make()
            ->withTitle('My Title')
            ->withContent('My Content');
    }
}
