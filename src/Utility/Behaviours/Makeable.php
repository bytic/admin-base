<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait Makeable
{
    public static function make(?string $name = null): self
    {
        return (new static)->withName($name);
    }
}