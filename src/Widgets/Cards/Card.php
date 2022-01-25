<?php

namespace ByTIC\AdminBase\Widgets\Cards;

use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasTheme;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Utility\ViewHelper;
use ByTIC\AdminBase\Widgets\AbstractWidget;
use Stringable;

/**
 * @method static Card make()
 */
class Card extends AbstractWidget
{
    use HasTitle;
    use HasContent;
    use HasHtmlAttributes;
    use HasTheme;

    /**
     * @var array
     */
    protected $headerTools = [];

    protected $wrapBody = true;

    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-widgets/card';

    public function addHeaderTool(Stringable $tool): self
    {
        $this->headerTools[] = $tool;
        return $this;
    }

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
        $attributes = $this->getHtmlAttributes();
        return array_merge(
            parent::renderVariables(),
            [
                'title' => $this->title,
                'content' => $this->getContent(),
                'attributes' => $attributes,
                'headerTools' => $this->headerTools,
                'wrapBody' => $this->wrapBody,
                'theme' => $this->theme,
                'themeMode' => $this->themeMode,
            ]
        );
    }
}