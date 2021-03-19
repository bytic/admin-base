<?php

namespace ByTIC\AdminBase\Library\View\Traits;

use ByTIC\AdminBase\AdminBase;
use ByTIC\AdminBase\Utility\Paths;
use ByTIC\AdminBase\Utility\ViewHelper;
use Nip\View\ViewFinder\ViewFinderInterface;

/**
 * Trait HasAdminBaseFolderTrait
 * @package ByTIC\AdminBase\Library\View\Traits
 *
 * @method addPath($path, $namespace = ViewFinderInterface::MAIN_NAMESPACE)
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
        ViewHelper::registerFrontendPaths($this);
    }

    /**
     * @return string
     */
    protected function adminBaseTheme()
    {
        return AdminBase::theme();
    }
}
