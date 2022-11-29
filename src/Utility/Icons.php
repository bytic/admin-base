<?php

namespace ByTIC\AdminBase\Utility;

use ByTIC\Icons\Icon;

/**
 *
 */
class Icons
{

    public static function for($icon): Icon|string
    {
        if ($icon instanceof Icon) {
            return $icon;
        }

        if (is_string($icon) && !empty($icon)) {
            if (strpos($icon, 'class="') !== false) {
                return $icon;
            }
            return static::byName($icon);
        }
        return static::generic();
    }

    /**
     * @param $icon
     * @return string
     */
    public static function byName($icon): string
    {
        $iconType = false;
        if (strpos($icon, 'glyphicon') === 0) {
            $iconType = 'glyphicon';
        } elseif (strpos($icon, 'fa-') === 0) {
            $iconType = 'fa';
        }
        $classPrefix = '';
        switch ($iconType) {
            case 'glyphicon':
                $classPrefix = 'glyphicon';
                break;
            case 'fa':
                $classPrefix = 'fa';
                break;
        }
        return '<i class="' . $classPrefix . ' ' . $icon . '"></i>';
    }

    public static function generic(): string
    {
        return '<i class="fa fa-th-large"></i>';
    }
}