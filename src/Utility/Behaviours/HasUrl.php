<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasUrl
{
    protected string $url = '';

    protected string $windowTarget = '';

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
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function hasUrl(): bool
    {
        return !empty($this->url);
    }

    public function windowTarget(): string
    {
        return $this->windowTarget;
    }

    /**
     * @param $windowTarget
     * @return $this
     */
    public function withWindowTarget($windowTarget): self
    {
        $this->windowTarget = $windowTarget;
        return $this;
    }
}