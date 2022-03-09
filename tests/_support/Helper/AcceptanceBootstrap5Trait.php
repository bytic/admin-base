<?php

namespace ByTIC\AdminBase\Tests\Helper;

use Codeception\Exception\ModuleException;
use Codeception\Module;

/**
 * Trait AcceptanceBootstrap4Trait
 * @package ByTIC\AdminBase\Tests\Helper
 */
trait AcceptanceBootstrap5Trait
{
    /**
     * @param $title
     */
    public function seeHeaderTitle($title)
    {
        $this->getBrowserModule()->see($title, '.page-header .page-title');
    }

    /**
     * @param $title
     */
    public function seePanelFilters()
    {
        $this->getBrowserModule()->seeElement(['css' => 'div.card form.filters']);
    }

    /**
     * @param $title
     */
    public function seePanelTitle($title)
    {
        $this->getBrowserModule()->see($title, '.card .card-title');
    }

    /**
     * @param $title
     * @return void
     * @throws ModuleException
     */
    public function clickSidebarSubmenuByTitle($title)
    {
        $this->getBrowserModule()->click($title,'#sidebar .sub-menu');
    }

    /**
     * @return Module|PhpBrowser
     * @throws ModuleException
     */
    abstract protected function getBrowserModule();
}
