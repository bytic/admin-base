<?php

namespace ByTIC\AdminBase\Tests\Widgets\Cards;

use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Widgets\Cards\Card;

/**
 *
 */
class CardTest extends AbstractTest
{
    public function test_basic()
    {
        $card = Card::make()
            ->withTitle('My Title')
            ->withContent('My Content');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/Widgets/Cards/basic.html'),
            (string)$card
        );
    }
}
