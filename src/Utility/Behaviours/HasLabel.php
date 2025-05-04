<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasLabel
{

    protected ?string $label = null;
    protected $showLabel = true;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideLabel(): self
    {
        $this->showLabel = false;
        return $this;
    }

    public function showLabel(): self
    {
        $this->showLabel = true;
        return $this;
    }

    public function labelIsShown(): bool
    {
        return $this->showLabel;
    }

    public function labelIsHidden(): bool
    {
        return $this->showLabel == false;
    }

}
