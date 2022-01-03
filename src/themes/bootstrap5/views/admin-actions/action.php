<?php
/** @var BaseAction $item */

use ByTIC\AdminBase\Actions\Dto\BaseAction;
use ByTIC\Html\Tags\Anchor;

$attributes = $item->getHtmlAttributes();
$attributes['title'] = $item->getLabel();
$label = implode(' ', [$item->getIcon(), $item->getLabel()]);
?>

<?= Anchor::url($item->getUrl(), $label, $attributes) ?>
