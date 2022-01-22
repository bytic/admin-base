<?php

namespace ByTIC\AdminBase\Screen\Layouts\Dto;

use ByTIC\AdminBase\Screen\Header\Dto\HeaderNav;

/**
 *
 */
abstract class AbstractLayout
{
    protected HeaderNav $headerNav;

    public function __construct()
    {
        $this->headerNav = new HeaderNav();
    }

    /**
     * @return HeaderNav
     */
    public function headerNav(): HeaderNav
    {
        return $this->headerNav;
    }

    /**
     * @param HeaderNav $headerNav
     */
    public function setHeaderNav(HeaderNav $headerNav): void
    {
        $this->headerNav = $headerNav;
    }
}