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
    public function __construct()
    {
        parent::__construct();
        $this->addAdminBaseNamespacePath();
    }

    /**
     * @deprecated Use addAdminBaseNamespacePath()
     */
    public function addNamespacePath()
    {
        $this->addAdminBaseNamespacePath();
    }

    public function addAdminBaseNamespacePath()
    {
        $this->addPath(__DIR__ . '/../../../themes/bootstrap3/views/', 'AdminBase');
        $this->addPath(__DIR__ . '/../../../themes/bootstrap3/views/');
    }
}
