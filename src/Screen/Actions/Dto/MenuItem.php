<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

/**
 *
 */
class MenuItem extends AbstractParentAction
{
    public const TYPE = 'menuitem';

    /**
     */
    public function isSelected(): bool
    {
        return $this->getDataItem('active') == true
            || $this->getDataItem('selected') == true;
    }
}