<?php

namespace ByTIC\AdminBase\Screen\Actions\Factories;

use ByTIC\AdminBase\Screen\Actions\Collections\ActionsCollection;
use InvalidArgumentException;

/**
 *
 */
class ActionsCollectionsFactory
{
    /**
     * @param $actions
     * @return ActionsCollection|void
     */
    public static function from($actions)
    {
        if ($actions instanceof ActionsCollection) {
            return $actions;
        }
        if (is_array($actions)) {
            return static::fromArray($actions);
        }
        throw new InvalidArgumentException('Actions must be an array or an instance of ActionsCollection');
    }

    public static function fromArray(array $actions): ActionsCollection
    {
        $actions = array_map(function ($action) {
            return ActionsFactory::from($action);
        }, $actions);
        return new ActionsCollection($actions);
    }
}