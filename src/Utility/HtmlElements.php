<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\Html\Dom\DomAttributes;

/**
 *
 */
class HtmlElements
{
    /**
     * @param AbstractAction $action
     * @return array|DomAttributes
     */
    public static function attributesForAction($action)
    {
        $attributes = $action->getHtmlAttributes();
        $attributes['title'] = $action->getLabel();
        $attributes['target'] = $action->windowTarget();
        return $attributes;
    }

    /**
     * @param AbstractAction $action
     * @return mixed
     */
    public static function contentForAction($action)
    {
        $content = [];
        $content[] = $action->getIcon();
        if ($action->labelIsShown()) {
            $content[] = $action->getLabel();
        }
        return implode(' ', $content);
    }
}