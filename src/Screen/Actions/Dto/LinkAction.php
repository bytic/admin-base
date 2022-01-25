<?php

namespace ByTIC\AdminBase\Screen\Actions\Dto;

use ByTIC\AdminBase\Utility\ViewHelper;

/**
 *
 */
class LinkAction extends AbstractAction
{
    public const VIEW = ViewHelper::VIEW_NAMESPACE . '::/admin-actions/link';
    public const TYPE = 'link';
}