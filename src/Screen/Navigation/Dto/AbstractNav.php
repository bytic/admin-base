<?php

namespace ByTIC\AdminBase\Screen\Navigation\Dto;

use ByTIC\AdminBase\Screen\ActionsGroups\Collections\ActionGroupsCollection;
use ByTIC\AdminBase\Screen\ActionsGroups\Dto\ActionsGroup;

/**
 *
 */
abstract class AbstractNav
{
    protected ActionGroupsCollection $actionsGroups;

    public function __construct()
    {
        $this->actionsGroups = new ActionGroupsCollection();
    }

    /**
     * @param $actionsGroup
     * @param $name
     * @return void
     */
    public function addActionsGroup($actionsGroup, $name = null)
    {
        $this->actionsGroups->add($actionsGroup, $name);
    }

    /**
     * @param $name
     * @return ActionsGroup|null
     */
    public function actionsGroup($name = null): ?ActionsGroup
    {
        return $this->actionsGroups->for($name);
    }

    /**
     * @param $toolbarAction
     * @param $toolbar
     * @return void
     */
    public function addGroupAction($toolbarAction, $toolbar = null)
    {
        $this->actionsGroups->addGroupAction($toolbarAction, $toolbar);
    }

    public function actionsGroups(): ActionGroupsCollection
    {
        return $this->actionsGroups;
    }
}