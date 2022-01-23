<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;

/**
 *
 */
class HtmlElements
{
    /**
     * @param AbstractAction $action
     * @return array
     */
    public static function attributesForAction($action): array
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