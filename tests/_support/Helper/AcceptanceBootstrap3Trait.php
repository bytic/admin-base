<?php

namespace ByTIC\AdminBase\Tests\Helper;

/**
 * Trait AcceptanceBootstrap3Trait
 * @package ByTIC\AdminBase\Tests\Helper
 */
trait AcceptanceBootstrap3Trait
{
    /**
     * @param $title
     */
    public function seeHeaderTitle($title)
    {
        $this->getBrowserModule()->see($title, '.page-title');
    }

    /**
     * @param $title
     */
    public function seePanelTitle($title)
    {
        $this->getBrowserModule()->see($title, '.panel .panel-title');
    }

    /**
     * @return \Codeception\Module|PhpBrowser
     * @throws \Codeception\Exception\ModuleException
     */
    abstract protected function getBrowserModule();
}
