<?php

namespace ByTIC\AdminBase\Screen\Layouts\Dto;

use ByTIC\AdminBase\Screen\Branding\Dto\Branding;
use ByTIC\AdminBase\Screen\Navigation\Dto\HeaderNav;
use ByTIC\AdminBase\Screen\Navigation\Dto\SidebarNav;

/**
 *
 */
abstract class AbstractLayout
{
    protected Branding $branding;
    protected HeaderNav $headerNav;
    protected SidebarNav $sidebarNav;

    public function __construct()
    {
        $this->headerNav = new HeaderNav();
        $this->sidebarNav = new SidebarNav();
        $this->branding = new Branding();
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

    public function sidebarNav(): SidebarNav
    {
        return $this->sidebarNav;
    }

    public function branding(): Branding
    {
        return $this->branding;
    }
}