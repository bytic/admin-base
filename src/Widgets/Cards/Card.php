<?php

namespace ByTIC\AdminBase\Widgets\Cards;

use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Utility\ViewHelper;
use ByTIC\AdminBase\Widgets\AbstractWidget;

/**
 * @method static Card make()
 */
class Card extends AbstractWidget
{
    use HasTitle;
    use HasContent;
    use HasHtmlAttributes;

    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-widgets/card';

    protected function renderVariables(): array
    {
        $attributes = $this->getHtmlAttributes();
        $attributes['class'] = 'card';
        return array_merge(
            parent::renderVariables(),
            [
                'title' => $this->title,
                'content' => $this->content,
                'attributes' => $attributes,
            ]
        );
    }
}