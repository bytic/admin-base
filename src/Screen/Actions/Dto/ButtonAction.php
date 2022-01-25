<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Utility\HtmlElements;
use ByTIC\AdminBase\Utility\ViewHelper;

/**
 *
 */
class ButtonAction extends AbstractAction
{
    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-actions/button';

    protected function renderVariables(): array
    {
        $attributes = HtmlElements::attributesForAction($this);
        $attributes['class'] = $attributes['class'] ?? '';
        $attributes['class'] = implode(' ', [$attributes['class'], 'btn btn-primary']);

        $content = HtmlElements::contentForAction($this);
        return array_merge(
            parent::renderVariables(),
            [
                'url' => $this->getUrl(),
                'attributes' => $attributes,
                'content' => $content
            ]
        );
    }
}