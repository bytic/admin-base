<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasTitle
{
    protected ?string $title = null;

    public function title(): ?string
    {
        return $this->title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setTitle($name): self
    {
        return $this->withTitle($name);
    }

    /**
     * @param string $name
     * @return self
     */
    public function withTitle(string $name): self
    {
        $this->title = $name;
        return $this;
    }
}
