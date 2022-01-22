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
            PROJECT_BASE_PATH . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'themes',
            Paths::themesBase()
        );
    }
}
