<?php

namespace ByTIC\AdminBase\Tests\Library\View\Traits;

use ByTIC\AdminBase\Tests\AbstractTest;
use ByTIC\AdminBase\Tests\Fixtures\ViewWithTrait;

/**
 * Class HasAdminBaseFolderTraitTest
 * @package ByTIC\AdminBase\Tests\Library\View\Traits
 */
class HasAdminBaseFolderTraitTest extends AbstractTest
{
    public function testAddNamespacePath()
    {
        $view = new ViewWithTrait();
        $view->addAdminBaseNamespacePath();

        $paths = $view->getFinder()->getPaths();
        self::assertArrayHasKey('AdminBase', $paths);

        $pathAdmin = $paths['AdminBase'];
        self::assertEquals(
            realpath(PROJECT_BASE_PATH . '/resources/themes/bootstrap5/views/'),
            realpath($pathAdmin[0])
        );

        $content = $view->load('AdminBase::breadcrumbs');
        self::assertEquals('', $content);
    }
}
