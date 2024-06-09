<?php

namespace ByTIC\AdminBase\Widgets\Cards;

use ByTIC\AdminBase\Utility\Behaviours\HasContent;
use ByTIC\AdminBase\Utility\Behaviours\HasData;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasIcon;
use ByTIC\AdminBase\Utility\Behaviours\HasTheme;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Utility\ViewHelper;
use ByTIC\AdminBase\Widgets\AbstractWidget;

/**
 * @method static Card make()
 */
class CardStats extends Card
{
    use HasData;

    public const DATA_VARIATION = 'percentage';

    public const DATA_VALUE_HELP = 'valueHelp';

    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-widgets/card_stats';

    /**
     * @param $value
     * @return self
     */
    public function setValue($value): self
    {
        return $this->setDataItem('value', $value);
    }

    /**
     * @param $url
     * @return self
     */
    public function setUrl($url): self
    {
        return $this->setDataItem('url', $url);
    }

    /**
     * @param $percentage
     * @return self
     */
    public function setVariation($percentage): self
    {
        return $this->setDataItem(self::DATA_VARIATION, $percentage);
    }

    /**
     * @param $valueHelp
     * @return HasData|CardStats
     */
    public function setValueHelp($valueHelp)
    {
        return $this->setDataItem(self::DATA_VALUE_HELP, $valueHelp);
    }
    protected function renderVariables(): array
    {
        return array_merge(
            parent::renderVariables(),
            [
                'data' => $this->checkData(),
            ]
        );
    }
}