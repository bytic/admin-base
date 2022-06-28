<?php

namespace ByTIC\AdminBase\Widgets\Cards\Behaviours;

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\Icons\Icons;
use Stringable;

/**
 *
 */
trait HasHeaderTools
{
    /**
     * @var array
     */
    protected $headerTools = [];

    public function addHeaderTool(Stringable $tool): self
    {
        $this->headerTools[] = $tool;
        return $this;
    }

    public function addHeaderToolCollapse(): self
    {
        $button = new ButtonAction();

        $icon = Icons::minus();

        $button->setIcon($icon);
        $button->addHtmlClass('btn-xs');
        $button->addHtmlClass('btn-flat');
        $button->setHtmlAttribute('role','button');

        $button->setUrl('#' . $this->getId().'-content');
        $button->htmlDataAttribute('bs-toggle', 'collapse');
        return $this->addHeaderTool($button);
    }
}

