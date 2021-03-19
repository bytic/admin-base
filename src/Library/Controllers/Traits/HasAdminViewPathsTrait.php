<?php

namespace ByTIC\AdminBase\Library\Controllers\Traits;

use ByTIC\AdminBase\Utility\ViewHelper;

/**
 * Trait HasAdminViewPathsTrait
 * @package ByTIC\AdminBase\Library\Controllers\Traits
 */
trait HasAdminViewPathsTrait
{
    protected function bootHasAdminViewPathsTrait()
    {
        $this->after(
            function () {
                $this->registerHelloViewPaths();
            }
        );
    }

    protected function registerHelloViewPaths()
    {
        $view = $this->getView();
        ViewHelper::registerFrontendPaths($view);
    }
}
