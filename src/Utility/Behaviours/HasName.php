<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasName
{

    protected string $name;

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->withName($name);
    }

    /**
     * @param string $name
     * @return self
     */
    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
