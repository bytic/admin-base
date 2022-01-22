<?php

use ByTIC\SeoMeta\Utility\SeoMeta;

SeoMeta::viewport()->addResponsive();
?>
<head>
    <?= $this->Meta(); ?>
    <?= $this->favicon->render(); ?>

    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?= $this->FacebookMeta(); ?>

    <?= $this->load('/modules/head-assets'); ?>
</head>