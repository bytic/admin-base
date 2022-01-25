<?php

namespace ByTIC\AdminBase;

/**
 * Class AdminBase
 * @package ByTIC\AdminBase
 */
class AdminBase
{
    protected static $theme = 'bootstrap5';

    /**
     * @param null $theme
     * @return string
     */
    public static function theme($theme = null)
    {
        if ($theme !== null) {
            static::$theme = $theme;
        }
        return static::$theme;
    }
}
