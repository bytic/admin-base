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

    public const TYPE_NAVIGATION = 'navigation';
    public const TYPE_BUTTON = 'button';

    protected $searchable = false;

    protected string $dropdown_type = self::TYPE_NAVIGATION;

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
     * @param $value
     * @return bool
     */
    public function isButton($value = null): bool
    {
        if ($value === true) {
            $this->dropdown_type = self::TYPE_BUTTON;
            return true;
        }
        return $this->dropdown_type === self::TYPE_BUTTON;
    }

    /**
     * @return ActionsCollection
     */
    public function getMenu(): ActionsCollection
    {
        return $this->actions();
    }
}