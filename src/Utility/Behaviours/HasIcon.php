<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

use ByTIC\Icons\Icon;

/**
 *
 */
trait HasIcon
{
    protected ?string $icon = null;

    public function hasIcon(): bool
    {
        return !empty($this->icon);
    }

    /**
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|Icon $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @param string|Icon $icon
     */
    public function withIcon($icon): self
    {
        $this->setIcon($icon);

        return $this;
    }
}
