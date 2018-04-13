<?php

namespace ByTIC\AdminBase\Tests\Fixtures;

use ByTIC\AdminBase\Library\View\Traits\HasAdminBaseFolderTrait;
use Nip\View;

/**
 * Class ViewWithTrait
 * @package ByTIC\AdminBase\Tests\Fixtures
 */
class ViewWithTrait extends View
{
    use HasAdminBaseFolderTrait;
}
