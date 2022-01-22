<?php

use ByTIC\AdminBase\Screen\Actions\Dto\BaseAction;
use ByTIC\Html\Tags\Anchor;

/** @var BaseAction $item */
$attributes = $item->getHtmlAttributes();
$attributes['title'] = $item->getLabel();
$label = implode(' ', [$item->getIcon(), $item->getLabel()]);
?>

<?= Anchor::url($item->getUrl(), $label, $attributes) ?>
