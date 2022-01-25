<?php

namespace ByTIC\AdminBase\Widgets;

use ByTIC\AdminBase\Utility\Behaviours\Makeable;
use ByTIC\AdminBase\Utility\Renderable\IsRenderable;
use ByTIC\AdminBase\Utility\Renderable\Renderable;

/**
 *
 */
abstract class AbstractWidget implements Renderable
{
    use IsRenderable;
    use Makeable;
}