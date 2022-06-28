<?php

namespace ByTIC\AdminBase\Widgets\Cards;

use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasIcon;
use ByTIC\AdminBase\Utility\Behaviours\HasTheme;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Utility\ViewHelper;
use ByTIC\AdminBase\Widgets\AbstractWidget;

/**
 * @method static Card make()
 */
class Card extends AbstractWidget
{
    use HasTitle;
    use HasIcon;
    use HasContent;
    use HasHtmlAttributes;
    use HasTheme;
    use Behaviours\HasHeaderTools;

    protected $wrapBody = true;

    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-widgets/card';


    /**
     * @param bool $wrap
     * @return $this
     */
    public function wrapBody(bool $wrap = true): self
    {
        $this->wrapBody = $wrap;
        return $this;
    }

    protected function renderVariables(): array
    {
        return array_merge(
            parent::renderVariables(),
            [
                'title' => $this->title,
                'icon' => $this->getIcon(),
                'content' => $this->getContent(),
                'attributes' => $this->htmlAttributesFor(),
                'attributes_body' => $this->htmlAttributesFor('body'),
                'headerTools' => $this->headerTools,
                'wrapBody' => $this->wrapBody,
                'theme' => $this->theme,
                'themeMode' => $this->themeMode,
            ]
        );
    }
}