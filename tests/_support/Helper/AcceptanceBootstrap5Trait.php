<?php

namespace ByTIC\AdminBase\Tests\Helper;

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
     * @return \Codeception\Module|PhpBrowser
     * @throws \Codeception\Exception\ModuleException
     */
    abstract protected function getBrowserModule();
}