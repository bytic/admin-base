<?php

namespace ByTIC\AdminBase\Tests\Widgets\Cards;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Mockery;
use Mockery\Mock;

/**
 *
 */
class CardTest extends AbstractTest
{
    public function test_basic()
    {
        $card = $this->basicCard();
        $card->addHtmlClass('my-class', 'body');

        self::assertEqualHtmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/basic.html',
            (string)$card
        );
    }

    public function test_basic_icon()
    {
        $card = $this->basicCard();
        $card->withIcon(
            Icons::search()
        );
        self::assertEqualHtmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/basic_icon.html',
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
        self::assertEqualHtmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/basic_tools.html',
            (string)$card
        );
    }

    public function test_success_outline()
    {
        $card = $this->basicCard();
        $card
            ->themeSuccess()
            ->themeModeOutline();

        self::assertEqualHtmlFile(
            TEST_FIXTURE_PATH . '/Widgets/Cards/success_outline.html',
            (string)$card
        );
    }

    /**
     * @return HasContent|HasTitle|Card
     */
    protected function basicCard()
    {
        return Card::make()
            ->setId('my-card')
            ->withTitle('My Title')
            ->withContent('My Content');
    }

    /**
     * @return Mock|Card
     */
    protected function cardMock()
    {
        return Mockery::mock(Card::class)->shouldAllowMockingProtectedMethods()->makePartial();
    }
}
