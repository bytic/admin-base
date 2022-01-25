<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait Makeable
{
    public static function make(?string $name = null): self
    {
        $make = new static();
        if (method_exists($make, 'setName')) {
            $make->setName($name);
        }
        if (method_exists($make, 'withName')) {
            $make->withName($name);
        }
        return $make;
    }
}