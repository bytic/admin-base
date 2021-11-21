<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\AdminBase\Library\View\Traits\HasAdminBaseFolderTrait;
use Nip\View\View;

/**
 * Class ViewHelper
 * @package ByTIC\AdminBase\Utility
 */
class ViewHelper
{
    /**
     * @param View|HasAdminBaseFolderTrait $view
     */
    public static function registerFrontendPaths(View $view)
    {
        $view->addPath(Paths::themePath('/views/'), 'AdminBase');
        $view->addPath(Paths::themePath('/views/'));

        $view->addPath(Paths::themePath('/views/', 'abstract'), 'AdminBase');
        $view->addPath(Paths::themePath('/views/', 'abstract'));
    }
}
