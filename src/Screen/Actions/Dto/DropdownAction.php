<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Utility\ViewHelper;

/**
 *
 */
class DropdownAction extends AbstractParentAction
{
    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-actions/dropdown';
    public const TYPE = 'dropdown';

    /**
     * @param AbstractAction $menuItem
     * @return $this
     */
    public function addMenuItem($menuItem): self
    {
        $this->addAction($menuItem);
        return $this;
    }

    /**
     * @return ActionsCollection
     */
    public function getMenu(): ActionsCollection
    {
        return $this->actions();
    }
}