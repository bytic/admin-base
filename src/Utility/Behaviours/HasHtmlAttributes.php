<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

use ByTIC\Html\Dom\DomAttributes;
use ByTIC\Html\Html\ClassList;

/**
 *
 */
trait HasHtmlAttributes
{
    protected $htmlAttributesRootElement = 'root';

    /**
     * @var DomAttributes[]
     */
    protected array $htmlAttributes = [];

    /**
     * @param $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setHtmlAttribute('id', $id);
    }

    /**
     * @return mixed|string|null
     */
    public function getId()
    {
        $id = $this->getHtmlAttribute('id');
        if (empty($id)) {
            $id = '_' . spl_object_hash($this);
            $this->setId($id);
        }
        return $id;
    }

    /**
     * @param string|callable $class
     * @return  static
     */
    public function addHtmlClass($class, $element = null): self
    {
        $classes = array_filter(explode(' ', $class), 'strlen');

        $this->getHtmlClassList($element)->add(...$classes);

        return $this;
    }

    /**
     * @param string|callable $class
     * @return  static
     */
    public function removeHtmlClass($class, $element = null): self
    {
//        $class = Str::toString($class);

        $classes = array_filter(explode(' ', $class), 'strlen');

        $this->getHtmlClassList($element)->remove(...$classes);

        return $this;
    }

    /**
     * @param string $class
     * @param bool|null $force
     * @param $element
     * @return $this
     */
    public function toggleHtmlClass(string $class, ?bool $force = null, $element = null): self
    {
        $this->getHtmlClassList($element)->toggle($class, $force);

        return $this;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function hasHtmlClass(string $class, $element = null)
    {
        return $this->getHtmlClassList($element)->contains($class);
    }

    /**
     * @return ClassList|mixed
     */
    public function getHtmlClassList($element = null)
    {
        $attributes = $this->htmlAttributesFor($element);

        return $attributes->getClassList();
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return  string|static
     */
    public function htmlDataAttribute(string $name, $value = null, $element = null)
    {
        $attributes = $this->htmlAttributesFor($element);
        if ($value === null) {
            return $attributes->data($name);
        }
        $attributes->data($name, $value);
        return $this;
    }

    /**
     * @param string $name Attribute name.
     * @param mixed $default Default value.
     */
    public function getHtmlAttribute($name, $default = null, $element = null)
    {
        return $this->htmlAttributesFor($element)->getAttribute($name, $default);
    }

    /**
     * @param string $name Attribute name.
     * @param string $value The value to set into attribute.
     */
    public function setHtmlAttribute($name, $value, $element = null): self
    {
        $this->htmlAttributesFor($element)->setAttribute($name, $value);

        return $this;
    }

    /**
     * @param string $name
     * @return  bool
     */
    public function hasHtmlAttribute($name, $element = null): bool
    {
        return $this->htmlAttributesFor($element)->hasAttribute($name);
    }

    /**
     * @param string $name
     * @return  static
     */
    public function removeHtmlAttribute($name, $element = null): self
    {
        $this->htmlAttributesFor($element)->removeAttribute($name);

        return $this;
    }

    /**
     * @param null $element
     * @return DomAttributes
     */
    public function getHtmlAttributes($element = null): DomAttributes
    {
        return $this->htmlAttributesFor($element);
    }

    /**
     * Set all attributes.
     * @param array $htmlAttributes
     */
    public function setHtmlAttributes(array|DomAttributes  $htmlAttributes, $element = null): self
    {
        $this->htmlAttributesFor($element)->setAttributes($htmlAttributes);
        return $this;
    }

    /**
     * @param $element
     * @return array|DomAttributes
     */
    public function htmlAttributesFor($element = null): DomAttributes
    {
        $element = $this->htmlAttributesElementName($element);
        if (!isset($this->htmlAttributes[$element])) {
            $attributes = new DomAttributes();
            $this->htmlAttributes[$element] = $attributes;
        }
        return $this->htmlAttributes[$element];
    }

    /**
     * @param $element
     * @return mixed|string|null
     */
    protected function htmlAttributesElementName($element = null)
    {
        if ($element === null) {
            $element = $this->htmlAttributesRootElement;
        }
        return $element;
    }
}
