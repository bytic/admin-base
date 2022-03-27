<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Utility\ViewHelper;

/**
 * @method DropdownAction static make()
 */
class DropdownAction extends AbstractParentAction
{
    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-actions/dropdown';
    public const TYPE = 'dropdown';

    protected $searchable = false;

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
     * @param $searchable
     * @return bool
     */
    public function searchable($searchable = null): bool
    {
        if (null !== $searchable) {
            $this->searchable = $searchable;
        }
        return $this->searchable;
    }

    /**
     * @return ActionsCollection
     */
    public function getMenu(): ActionsCollection
    {
        return $this->actions();
    }
}