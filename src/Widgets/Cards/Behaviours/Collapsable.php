<?php

namespace ByTIC\AdminBase\Widgets\Cards\Behaviours;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\Icons\Icons;

/**
 *
 */
trait Collapsable
{
    /**
     * @return self
     */
    public function collapsable(): self
    {
        $this->addHtmlClass('collapse show', 'body');

        $button = new ButtonAction();

        $icon = Icons::minus();

        $button->setIcon($icon);
        $button->addHtmlClass('btn-xs');
        $button->addHtmlClass('btn-flat');
        $button->setHtmlAttribute('role', 'button');

        $button->setUrl('#' . $this->getId() . '-content');
        $button->htmlDataAttribute('bs-toggle', 'collapse');
        return $this->addHeaderTool($button);
    }

    /**
     * @return self
     */
    public function collapsed(): self
    {
        return $this->removeHtmlClass('show', 'body');
    }
}