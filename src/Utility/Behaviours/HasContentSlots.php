<?php

namespace ByTIC\AdminBase\Utility\Behaviours;

/**
 *
 */
trait HasContentSlots
{

    protected $contentData = [];

    public const CONTENT_SUFFIX = 'suffix';

    public function addContentSuffix($content): self
    {
        $this->contentData[self::CONTENT_SUFFIX][] = $content;
        return $this;
    }

    public function getContentData(): array
    {
        return $this->contentData;
    }

    public function getContentSuffixString(): string
    {
        return implode('', $this->contentData[self::CONTENT_SUFFIX] ?? []);
    }
}
