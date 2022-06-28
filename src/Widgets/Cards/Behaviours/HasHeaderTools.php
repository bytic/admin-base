<?php

namespace ByTIC\AdminBase\Widgets\Cards\Behaviours;

use Stringable;

/**
 *
 */
trait HasHeaderTools
{
    /**
     * @var array
     */
    protected $headerTools = [];

    public function addHeaderTool(Stringable $tool): self
    {
        $this->headerTools[] = $tool;
        return $this;
    }
}

