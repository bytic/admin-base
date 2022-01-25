<?php

namespace ByTIC\AdminBase\Utility\Renderable;

use ByTIC\AdminBase\Utility\ViewHelper;
use Nip\View\View;

/**
 *
 */
trait IsRenderable
{
    protected $viewEngine = null;

    /**
     * @var bool|callable
     */
    protected $shouldRender = true;

    public function renderIf(callable $callable): self
    {
        $this->shouldRender = $callable;

        return $this;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function render(): ?string
    {
        if (false === $this->shouldRender()) {
            return null;
        }
        return $this->renderHtml();
    }

    /**
     * @return bool
     */
    protected function shouldRender(): bool
    {
        if ($this->shouldRender == false) {
            return false;
        }
        if (is_callable($this->shouldRender)) {
            return call_user_func($this->shouldRender);
        }

        return true;
    }

    protected function renderHtml(): string
    {
        return $this->renderEngine()->load(
            $this->renderTemplatePath(),
            $this->renderVariables(),
            true
        );
    }

    protected function renderEngine(): ?View
    {
        if ($this->viewEngine === null) {
            $this->viewEngine = $this->renderEngineGenerate();
        }
        return $this->viewEngine;
    }

    protected function renderEngineGenerate(): View
    {
        return ViewHelper::view();
    }

    protected function renderTemplatePath(): ?string
    {
        if (defined(static::class . '::VIEW')) {
            return static::VIEW;
        }
        return null;
    }

    protected function renderVariables(): array
    {
        return [];
    }
}