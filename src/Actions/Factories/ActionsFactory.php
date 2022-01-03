<?php

namespace ByTIC\AdminBase\Actions\Factories;

use ByTIC\AdminBase\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Actions\Dto\BaseAction;
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
        $action = new BaseAction();
        if (isset($data['name'])) {
            $action->setName($data['name']);
        }
        if (isset($data['label'])) {
            $action->setLabel($data['label']);
        }

        return $action;
    }
}