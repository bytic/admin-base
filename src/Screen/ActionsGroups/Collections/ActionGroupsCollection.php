<?php

namespace ByTIC\AdminBase\Screen\ActionsGroups\Collections;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;
use Nip\Collections\Typed\ClassCollection;

/**
 *
 */
class ActionGroupsCollection extends ClassCollection
{
    protected $validClass = ActionsGroup::class;

    protected $defaultName = ActionsGroup::NAME_DEFAULT;

    /**
     * @param $toolbarAction
     * @param $name
     * @return void
     */
    public function addGroupAction($toolbarAction, $name = null)
    {
        $this->for($name)->addAction($toolbarAction);
    }

    /**
     * @param $name
     * @return AbstractAction|ActionsGroup|Makeable|mixed
     */
    public function for($name = null)
    {
        $name = $this->guardName($name);
        if (false === $this->has($name)) {
            $toolbar = ActionsGroup::make($name);
            $this->set($name, $toolbar);
            return $toolbar;
        }

        return $this->get($name);
    }

    /**
     * @param $name
     * @return string
     */
    public function guardName($name = null): string
    {
        return $name ?: $this->defaultName;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value): void
    {
        /** @var ActionsGroup $value */
        $key = empty($key) ? $value->getName() : $key;
        parent::offsetSet($key, $value);
    }
}
