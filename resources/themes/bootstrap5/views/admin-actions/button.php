<?php

use ByTIC\Html\Tags\Anchor;

$url = $url ?? '';
$content = $content ?? '';
$attributes = $attributes ?? '';
?>

<?= Anchor::url($url, $content, $attributes) ?>
