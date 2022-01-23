<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasIcon;
use ByTIC\AdminBase\Utility\Behaviours\HasName;
use ByTIC\AdminBase\Utility\Behaviours\HasUrl;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;

/**
 *
 */
abstract class AbstractAction implements Action
{
    use HasName;
    use Makeable;
    use HasIcon;
    use HasHtmlAttributes;
    use HasUrl;

    public const TYPE = 'action';

    protected string $type;

    protected ?string $label = null;
    protected $showLabel = true;

    public function __construct()
    {
        $this->type = static::TYPE;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

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

    /**
     * @return string
     */
    public function getHtmlElement(): string
    {
        return $this->htmlElement;
    }

    /**
     * @param string $htmlElement
     */
    public function setHtmlElement(string $htmlElement): void
    {
        $this->htmlElement = $htmlElement;
    }
}