<?php

namespace ByTIC\AdminBase\Screen\Actions\Factories;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Screen\Actions\Dto\AbstractParentAction;
use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\Actions\Dto\MenuItem;
use ByTIC\AdminBase\Utility\Icons;
use Exception;

/**
 *
 */
class ActionsFactory
{
    /**
     * @param $action
     * @return AbstractAction|ButtonAction
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

    public static function fromArray(array $data): AbstractAction
    {
        $action = static::createActionObject($data);
        return static::fillWithData($action, $data);
    }

    /**
     * @param $data
     * @return AbstractAction
     */
    protected static function createActionObject($data)
    {
        if (isset($data['submenus']) && is_array($data['submenus'])) {
            return new MenuItem();
        }

        $class = static::getActionClass($data['type'] ?? null);
        /** @var AbstractAction $action */
        return new $class();
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

            case ButtonAction::TYPE:
                return ButtonAction::class;

            case MenuItem::TYPE:
            default:
                return MenuItem::class;
        }
    }

    /**
     * @param AbstractAction $action
     * @param array $data
     * @return AbstractAction
     */
    protected static function fillWithData(AbstractAction $action, array $data): AbstractAction
    {
        if (isset($data['name'])) {
            $action->setName($data['name']);
            $action->setLabel($data['name']);
        }

        if (isset($data['label'])) {
            $action->setLabel($data['label']);
        }

        if (isset($data['class'])) {
            $action->addHtmlClass($data['class']);
        }

        if (isset($data['url'])) {
            $action->setUrl($data['url']);
        }

        $action->setIcon(Icons::for($data['icon'] ?? ''));

        if (isset($data['submenus']) && is_array($data['submenus'])) {
            if ($action instanceof AbstractParentAction) {
                $subActions = ActionsCollectionsFactory::fromArray($data['submenus']);
                foreach ($subActions as $subAction) {
                    $action->actions()->add($subAction);
                }
            }

        }

        return $action;
    }
}