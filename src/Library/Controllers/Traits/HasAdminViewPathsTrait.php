<?php

namespace ByTIC\AdminBase\Library\Controllers\Traits;

use ByTIC\AdminBase\Screen\Layouts\Dto\AbstractLayout;
use ByTIC\AdminBase\Screen\Layouts\Dto\BaseLayout;
use ByTIC\AdminBase\Utility\ViewHelper;

/**
 * Trait HasAdminViewPathsTrait
 * @package ByTIC\AdminBase\Library\Controllers\Traits
 */
trait HasAdminViewPathsTrait
{
    protected $adminBaseLayout = null;

    protected function bootHasAdminViewPathsTrait()
    {
        $this->after(
            function () {
                $this->registerHelloViewPaths();
                $this->registerAdminBaseLayout();
            }
        );
    }

    protected function registerHelloViewPaths()
    {
        $view = $this->getView();
        ViewHelper::registerFrontendPaths($view);
    }

    protected function registerAdminBaseLayout()
    {
        ViewHelper::registerLayoutVariables($this->payload(), $this->adminBaseLayout());
    }

    protected function adminBaseLayout(): ?AbstractLayout
    {
        if ($this->adminBaseLayout === null) {
            $this->adminBaseLayout = $this->adminBaseLayoutGenerate();
        }
        return $this->adminBaseLayout;
    }

    protected function adminBaseLayoutGenerate(): AbstractLayout
    {
        return new BaseLayout();
    }
}
