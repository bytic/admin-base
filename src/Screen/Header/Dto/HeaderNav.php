<?php

namespace ByTIC\AdminBase\Screen\Header\Dto;

use ByTIC\AdminBase\Screen\ActionToolbars\Collections\ActionToolbarsCollection;
use ByTIC\AdminBase\Screen\ActionToolbars\Dto\ActionToolbar;

/**
 *
 */
class HeaderNav
{
    protected $menu = [];

    protected $sections = [];

    protected ActionToolbarsCollection $toolbars;

    public function __construct()
    {
        $this->toolbars = new ActionToolbarsCollection();
    }

    /**
     * @param $toolbar
     * @param $name
     * @return void
     */
    public function addToolbar($toolbar, $name = null)
    {
        $this->toolbars->add($toolbar, $name);
    }

    /**
     * @param $name
     * @return ActionToolbar|null
     */
    public function getToolbar($name = null): ?ActionToolbar
    {
        return $this->toolbars->toolbar($name);
    }

    /**
     * @param $toolbarAction
     * @param $toolbar
     * @return void
     */
    public function addToolbarAction($toolbarAction, $toolbar = null)
    {
        $this->toolbars()->toolbar($toolbar)->addAction($toolbarAction);
    }

    public function toolbars(): ActionToolbarsCollection
    {
        return $this->toolbars;
    }
}