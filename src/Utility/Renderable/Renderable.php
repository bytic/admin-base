<?php

namespace ByTIC\AdminBase\Utility\Renderable;

use Bytic\Contracts\Support\Renderable as BaseRenderable;
use Stringable;

/**
 *
 */
interface Renderable extends BaseRenderable, Stringable
{
    public function renderIf(callable $callable): self;
}