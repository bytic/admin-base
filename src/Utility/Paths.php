<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\AdminBase\AdminBase;

/**
 * Class Paths
 * @package ByTIC\AdminBase\Utility
 */
class Paths
{
    /**
     * @param $path
     * @param $theme
     * @return string
     */
    public static function themePath($path, $theme = null)
    {
        return static::themeBase($theme) . $path;
    }

    /**
     * @param $theme
     * @return string
     */
    public static function themeBase($theme = null)
    {
        $theme = $theme ?: AdminBase::theme();
        return static::themesBase() . DIRECTORY_SEPARATOR . $theme;
    }

    /**
     * @return string
     */
    public static function themesBase(): string
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'themes';
    }
}
