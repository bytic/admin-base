<?php

namespace ByTIC\AdminBase\Screen\ActionsGroups\Dto;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Utility\Behaviours\HasActionsCollection;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasName;
use ByTIC\AdminBase\Utility\Behaviours\HasTitle;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;

/**
 *
 */
class ActionsGroup
{
    use Makeable;
    use HasName;
    use HasTitle;
    use HasHtmlAttributes;
    use HasActionsCollection;

    public const NAME_DEFAULT = 'main';

    public function __construct()
    {
        $this->actions = new ActionsCollection();
        $this->name = self::NAME_DEFAULT;
    }
}
