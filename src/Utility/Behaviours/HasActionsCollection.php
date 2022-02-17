<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Screen\Actions\Dto\Action;

/**
 *
 */
trait HasActionsCollection
{
    protected ActionsCollection $actions;

    /**
     * @return ActionsCollection
     */
    public function actions(): ActionsCollection
    {
        return $this->actions;
    }

    public function hasChildren(): bool
    {
        return $this->hasActions();
    }

    public function hasActions(): bool
    {
        return $this->actions->count() > 0;
    }

    public function getAction(string $name): ?Action
    {
        return $this->actions->get($name);
    }

    public function addAction(Action $action): self
    {
        $this->actions->add($action);
        return $this;
    }
}