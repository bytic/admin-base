<?php

namespace ByTIC\AdminBase\Screen\ActionToolbars\Collections;

use ByTIC\AdminBase\Screen\Actions\Dto\AbstractAction;
use ByTIC\AdminBase\Screen\ActionToolbars\Dto\ActionToolbar;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;
use Nip\Collections\Typed\ClassCollection;

/**
 *
 */
class ActionToolbarsCollection extends ClassCollection
{
    protected $validClass = ActionToolbar::class;

    protected $defaultToolbar = ActionToolbar::NAME_DEFAULT;

    /**
     * @param $name
     * @return AbstractAction|ActionToolbar|Makeable|mixed
     */
    public function toolbar($name = null)
    {
        $name = $name ?: $this->defaultToolbar();
        if (false === $this->has($name)) {
            $toolbar = ActionToolbar::make($name);
            $this->set($name, $toolbar);
            return $toolbar;
        }

        return $this->get($name);
    }

    public function defaultToolbar(): string
    {
        return $this->defaultToolbar;
    }

    public function addToolbar(ActionToolbar $actionToolbar)
    {
        $this->add($actionToolbar);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value)
    {
        /** @var ActionToolbar $value */
        $key = empty($key) ? $value->getName() : $key;
        parent::offsetSet($key, $value);
    }
}
