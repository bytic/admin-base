<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

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
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function withIcon(string $icon): self
    {
        $this->setIcon($icon);

        return $this;
    }
}
