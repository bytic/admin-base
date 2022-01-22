<?php

namespace ByTIC\AdminBase\Screen\ActionToolbars\Dto;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use ByTIC\AdminBase\Utility\Behaviours\HasName;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;

/**
 *
 */
class ActionToolbar
{
    use Makeable;
    use HasName;

    public const NAME_DEFAULT = 'main';

    protected ActionsCollection $actions;

    public function __construct()
    {
        $this->actions = new ActionsCollection();
        $this->name = self::NAME_DEFAULT;
    }

    /**
     * @return ActionsCollection
     */
    public function actions(): ActionsCollection
    {
        return $this->actions;
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
