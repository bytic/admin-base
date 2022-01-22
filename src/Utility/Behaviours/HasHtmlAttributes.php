<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasHtmlAttributes
{
    protected string $cssClass;
    protected string $htmlElement;
    protected array $htmlAttributes = [
        'class' => '',
    ];

    /**
     * @param $class
     * @return string
     */
    public function addCssClass($class): string
    {
        $this->htmlAttributes['class'] .= ' ' . $class;
    }

    /**
     * @return string
     */
    public function getCssClass(): string
    {
        return $this->htmlAttributes['class'];
    }

    /**
     * @param string $cssClass
     */
    public function setCssClass(string $cssClass): void
    {
        $this->htmlAttributes['class'] = $cssClass;
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

}
