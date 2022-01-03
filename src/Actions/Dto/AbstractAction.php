<?php

namespace ByTIC\AdminBase\Actions\Dto;

/**
 *
 */
abstract class AbstractAction implements Action
{
    protected string $type;

    protected string $name;
    protected string $label;
    protected string $icon;

    protected string $cssClass;
    protected string $htmlElement;
    protected array $htmlAttributes = [];

    protected string $url = '';

    /**
     * @return string
     */
    public function getType(): string
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getIcon(): string
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

    /**
     * @return string
     */
    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    /**
     * @param string $cssClass
     */
    public function setCssClass(string $cssClass): void
    {
        $this->cssClass = $cssClass;
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
     * @return array
     */
    public function getHtmlAttributes(): array
    {
        return $this->htmlAttributes;
    }

    /**
     * @param array $htmlAttributes
     */
    public function setHtmlAttributes(array $htmlAttributes): void
    {
        $this->htmlAttributes = $htmlAttributes;
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