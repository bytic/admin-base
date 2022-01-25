<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasContent
{
    protected ?string $content = null;

    public function content(): ?string
    {
        return $this->content;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setContent($name): self
    {
        return $this->withContent($name);
    }

    /**
     * @param string $name
     * @return self
     */
    public function withContent(string $name): self
    {
        $this->content = $name;
        return $this;
    }
}
