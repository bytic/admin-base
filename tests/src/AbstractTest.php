<?php

namespace ByTIC\AdminBase\Tests;


use Bytic\Phpqa\PHPUnit\TestCase;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{

    /**
     * Compare two HTML fragments.
     */
    protected function assertEqualHtmlFile($path, $actual)
    {
        $this->assertEqualHtml(
            file_get_contents($path),
            $actual
        );
    }

    /**
     * Compare two HTML fragments.
     */
    protected function assertEqualHtml($expected, $actual)
    {
        $from = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/> </s'];
        $to = ['>', '<', '\\1', '><'];
        $this->assertEquals(
            preg_replace($from, $to, $expected),
            preg_replace($from, $to, $actual)
        );
    }
}
