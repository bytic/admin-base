<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasIcon;
use ByTIC\AdminBase\Utility\Behaviours\HasName;
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

    public const TYPE = 'action';

    protected string $type;

    protected ?string $label = null;


    protected string $url = '';

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

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function hasUrl(): bool
    {
        return !empty($this->url);
    }
}