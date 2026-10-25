<?php

declare(strict_types=1);

namespace ByTIC\AdminBase\Tests\Screen\Actions\Dto;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Widgets\Cards\Card;
use Nip\Collections\Collection;

/**
 *
 */
class ButtonActionTest extends AbstractTest
{
    public function test_html_element_has_a_default_and_can_be_changed(): void
    {
        $item = ButtonAction::make();

        self::assertSame('a', $item->getHtmlElement());

        $item->setHtmlElement('button');

        self::assertSame('button', $item->getHtmlElement());
    }

    public function test_data_collection_is_always_available(): void
    {
        self::assertInstanceOf(Collection::class, ButtonAction::make()->getData());
    }

    public function test_basic()
    {
        $item = $this->basicButton();

        self::assertEqualHtmlFile(
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
