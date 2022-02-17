<?php

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Utility\HtmlElements;
use ByTIC\Html\Tags\Anchor;

/** @var ButtonAction $item */
$attributes = HtmlElements::attributesForAction($item);
$content = HtmlElements::contentForAction($item);
?>

<?= Anchor::url($item->getUrl(), $content, $attributes) ?>
