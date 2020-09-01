<?php

namespace ByTIC\AdminBase\Tests\Helper;

/**
 * Trait AcceptanceBootstrap4Trait
 * @package ByTIC\AdminBase\Tests\Helper
 */
trait AcceptanceBootstrap4Trait
{

    /**
     * @param $title
     */
    public function seeHeaderTitle($title)
    {
        $this->getBrowserModule()->see($title, 'h2');
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