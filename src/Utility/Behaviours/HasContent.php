<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasContent
{
    protected $content = null;

    public function content(): ?string
    {
        return $this->content;
    }

    public function getContent(): ?string
    {
        if (is_callable($this->content)) {
            $this->content = call_user_func($this->content);
        }

        return $this->content;
    }

    /**
     * @param string|callable $name
     * @return $this
     */
    public function setContent($name): self
    {
        return $this->withContent($name);
    }

    /**
     * @param string|callable $name
     * @return self
     */
    public function withContent($name): self
    {
        $this->content = $name;
        return $this;
    }

    /**
     * @param $template
     * @param $variables
     * @return $this
     */
    public function withViewContent($template, $variables = []): self
    {
        return $this->withContent(function () use ($template, $variables) {
            return $this->renderEngine()->load($template, $variables, true);
        });
    }
}
