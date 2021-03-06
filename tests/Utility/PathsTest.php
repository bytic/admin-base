<?php

namespace ByTIC\AdminBase\Tests\Utility;

use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Utility\Paths;

/**
 * Class PathsTest
 * @package ByTIC\AdminBase\Tests\Utility
 */
class PathsTest extends AbstractTest
{
    public function test_themesBase()
    {
        self::assertSame(
            dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'themes',
            Paths::themesBase()
        );
    }
}
