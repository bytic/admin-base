<?php

namespace ByTIC\AdminBase\Screen\Actions\Factories;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Screen\Actions\Dto\BaseAction;
use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use Exception;

/**
 *
 */
class ActionsFactory
{
    /**
     * @param $action
     * @return AbstractAction|BaseAction
     * @throws Exception
     */
    public static function from($action)
    {
        if ($action instanceof AbstractAction) {
            return $action;
        }

        if (is_array($action)) {
            return static::fromArray($action);
        }
        throw new Exception('Action must be an array or an instance of AbstractAction');
    }

    public static function fromArray(array $data): BaseAction
    {
        $class = static::getActionClass($data['type'] ?? null);
        $action = new $class();
        if (isset($data['name'])) {
            $action->setName($data['name']);
        }

        if (isset($data['label'])) {
            $action->setLabel($data['label']);
        }

        if (isset($data['url'])) {
            $action->setUrl($data['url']);
        }

        if (isset($data['icon'])) {
            $action->setIcon($data['icon']);
        }

        return $action;
    }

    /**
     * @param $type
     * @return string
     */
    protected static function getActionClass($type): string
    {
        switch ($type) {
            case DropdownAction::TYPE:
                return DropdownAction::class;

            case MenuItem::TYPE:
                return MenuItem::class;
        }
        return BaseAction::class;
    }
}