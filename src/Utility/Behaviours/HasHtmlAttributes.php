<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

use ByTIC\Html\Html\ClassList;

/**
 *
 */
trait HasHtmlAttributes
{
    protected string $htmlElement;

    protected array $htmlAttributes = [];

    /**
     * @param string|callable $class
     * @return  static
     */
    public function addHtmlClass($class): self
    {
        $classes = array_filter(explode(' ', $class), 'strlen');

        $this->getHtmlClassList()->add(...$classes);

        return $this;
    }

    /**
     * @param string|callable $class
     * @return  static
     */
    public function removeHtmlClass($class): self
    {
//        $class = Str::toString($class);

        $classes = array_filter(explode(' ', $class), 'strlen');

        $this->getHtmlClassList()->remove(...$classes);

        return $this;
    }

    public function toggleHtmlClass(string $class, ?bool $force = null): self
    {
        $this->getHtmlClassList()->toggle($class, $force);

        return $this;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function hasHtmlClass(string $class)
    {
        return $this->getHtmlClassList()->contains($class);
    }

    /**
     * @return ClassList|mixed
     */
    public function getHtmlClassList()
    {
        if (!isset($this->htmlAttributes['class'])) {
            $this->htmlAttributes['class'] = ClassList::create([]);
        }
        if (!($this->htmlAttributes['class'] instanceof ClassList)) {
            $this->htmlAttributes['class'] = ClassList::create($this->htmlAttributes['class']);
        }
        return $this->htmlAttributes['class'];
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return  string|static
     */
    public function htmlDataAttribute(string $name, $value = null)
    {
        if ($value === null) {
            return $this->getHtmlAttribute('data-' . $name);
        }

        return $this->setHtmlAttribute('data-' . $name, $value);
    }

    /**
     * @param string $name Attribute name.
     * @param mixed $default Default value.
     */
    public function getHtmlAttribute($name, $default = null)
    {
        if (empty($this->htmlAttributes[$name])) {
            return $default;
        }

        return $this->htmlAttributes[$name];
    }

    /**
     * @param string $name Attribute name.
     * @param string $value The value to set into attribute.
     */
    public function setHtmlAttribute($name, $value): self
    {
        $this->htmlAttributes[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @return  bool
     */
    public function hasHtmlAttribute($name): bool
    {
        return isset($this->htmlAttributes[$name]);
    }

    /**
     * @param string $name
     * @return  static
     */
    public function removeHtmlAttribute($name): self
    {
        unset($this->htmlAttributes[$name]);

        return $this;
    }

    /**
     * @return array
     */
    public function getHtmlAttributes(): array
    {
        return $this->htmlAttributes;
    }

    /**
     * Set all attributes.
     * @param array $htmlAttributes
     */
    public function setHtmlAttributes(array $htmlAttributes): self
    {
        $this->htmlAttributes = $htmlAttributes;
        return $this;
    }

}
