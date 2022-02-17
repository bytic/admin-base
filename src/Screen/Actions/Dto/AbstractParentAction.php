<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Utility\Behaviours\HasActionsCollection;

/**
 *
 */
abstract class AbstractParentAction extends AbstractAction
{
    use HasActionsCollection;

    public function __construct()
    {
        parent::__construct();
        $this->actions = new ActionsCollection();
    }

}