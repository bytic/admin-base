<?php

use ByTIC\AdminBase\Screen\Actions\Dto\BaseAction;
use ByTIC\AdminBase\Utility\HtmlElements;
use ByTIC\Html\Tags\Anchor;

/** @var BaseAction $item */
$attributes = HtmlElements::attributesForAction($item);
$content = HtmlElements::contentForAction($item);

$attributes['class'] = implode(' ', [$attributes['class'], 'btn btn-primary']);
?>

<?= Anchor::url($item->getUrl(), $content, $attributes) ?>
