<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Utility\Behaviours\HasData;
use ByTIC\AdminBase\Utility\Behaviours\HasHtmlAttributes;
use ByTIC\AdminBase\Utility\Behaviours\HasIcon;
use ByTIC\AdminBase\Utility\Behaviours\HasLabel;
use ByTIC\AdminBase\Utility\Behaviours\HasName;
use ByTIC\AdminBase\Utility\Behaviours\HasUrl;
use ByTIC\AdminBase\Utility\Behaviours\Makeable;
use ByTIC\AdminBase\Utility\Renderable\IsRenderable;
use ByTIC\AdminBase\Utility\Renderable\Renderable;

/**
 *
 */
abstract class AbstractAction implements Action, Renderable
{
    use HasName;
    use Makeable;
    use HasIcon;
    use HasLabel;
    use HasData;
    use HasHtmlAttributes;
    use HasUrl;
    use IsRenderable;

    public const TYPE = 'action';

    protected string $type;

    public function __construct()
    {
        $this->type = static::TYPE;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getHtmlElement(): string
    {
        return $this->htmlElement;
    }

    /**
     * @param string $htmlElement
     */
    public function setHtmlElement(string $htmlElement): void
    {
        $this->htmlElement = $htmlElement;
    }

    protected function renderVariables(): array
    {
        return ['item' => $this];
    }
}