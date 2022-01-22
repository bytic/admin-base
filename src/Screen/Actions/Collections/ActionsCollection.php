<?php

namespace ByTIC\AdminBase\Screen\Actions\Collections;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use Nip\Collections\Typed\ClassCollection;

/**
 *
 */
class ActionsCollection extends ClassCollection
{
    protected $validClass = AbstractAction::class;

    public function addToolbarAction(AbstractAction $action)
    {
        $action->setType(Action::TYPE_TOOLBAR);
        $this->add($action);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value)
    {
        $key = empty($key) ? $value->getName() : $key;
        parent::offsetSet($key, $value);
    }
}
