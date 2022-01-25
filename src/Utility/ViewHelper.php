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
    public const VIEW_NAMESPACE = 'AdminBase';

    /**
     * @param View|HasAdminBaseFolderTrait $view
     */
    public static function registerFrontendPaths(View $view)
    {
        $view->addPath(Paths::themePath('/views/'), self::VIEW_NAMESPACE);
        $view->addPath(Paths::themePath('/views/'));

        $view->addPath(Paths::themePath('/views/', 'abstract'), self::VIEW_NAMESPACE);
        $view->addPath(Paths::themePath('/views/', 'abstract'));
    }

    /**
     * @return View
     */
    public static function view(): View
    {
        static $instance;
        if (!($instance instanceof View)) {
            $instance = new View();
            ViewHelper::registerFrontendPaths($instance);
        }
        return $instance;
    }
}
