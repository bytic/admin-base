<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\AdminBase\Library\View\Traits\HasAdminBaseFolderTrait;
use ByTIC\AdminBase\Screen\Layouts\Dto\BaseLayout;
use Nip\View\View;

/**
 * Class ViewHelper
 * @package ByTIC\AdminBase\Utility
 */
class ViewHelper
{
    public const VIEW_NAMESPACE = 'AdminBase';

    public const VIEW_VAR_LAYOUT = '_adminBaseLayout';
    public const VIEW_VAR_HEADER = '_adminBaseHeaderNav';
    public const VIEW_VAR_SIDEBAR = '_adminBaseSidebarNav';

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
     * @param View $view
     * @param $layout
     * @return void
     */
    public static function registerLayoutVariables($view, $layout = null)
    {
        $layout = $layout ?? new BaseLayout();
        $view->with([
            static::VIEW_VAR_LAYOUT => $layout,
            static::VIEW_VAR_HEADER => $layout->headerNav(),
            static::VIEW_VAR_SIDEBAR => $layout->sidebarNav(),
        ]);
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
