<?php

namespace ByTIC\AdminBase\Widgets\Cards\Behaviours;

/**
 *
 */
trait HasFooter
{
    /**
     * @var string|callable|null
     */
    protected $footer = null;

    /**
     * @param string|callable|null $footer
     */
    public function withFooter($footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * @param string|callable|null $footer
     */
    public function setFooter($footer): self
    {
        return $this->withFooter($footer);
    }

    /**
     * @return string|null
     */
    public function getFooter(): ?string
    {
        if (is_callable($this->footer)) {
            $this->footer = call_user_func($this->footer);
        }

        if ($this->footer === null) {
            return null;
        }

        return (string)$this->footer;
    }
}

