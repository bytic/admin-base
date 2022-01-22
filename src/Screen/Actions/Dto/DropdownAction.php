<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

/**
 *
 */
class DropdownAction extends AbstractAction
{
    public const TYPE = 'dropdown';

    /**
     * @var AbstractAction[]
     */
    protected $menu = [];

    /**
     * @param AbstractAction $menuItem
     * @return $this
     */
    public function addMenuItem($menuItem): self
    {
        $this->menu[] = $menuItem;
        return $this;
    }

    /**
     * @return AbstractAction[]
     */
    public function getMenu(): array
    {
        return $this->menu;
    }
}