<?php

namespace ByTIC\AdminBase\Library\View\Traits;

/**
 * Trait HasAdminBaseFolderTrait
 * @package ByTIC\AdminBase\Library\View\Traits
 *
 * @method addPath($path, $namespace)
 */
trait HasAdminBaseFolderTrait
{
    public function addNamespacePath()
    {
        $this->addPath(__DIR__ . '/../../../themes/bootstrap3/views/', 'AdminBase');
    }
}
