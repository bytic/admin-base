<?php /** @var \Nip\View $this */ ?>
<div class="page-header">
    <h1 class="page-title">
        <?php echo $this->title; ?>
    </h1>

    <?php echo $this->controller == 'error' ? '' : $this->Breadcrumbs(); ?>

    <div class="page-actions">
        <?php
        $viewFile = "/" . $this->controller . "/modules/header-buttons/" . $this->action;
        if ($this->existPath($viewFile)) {
            $this->load($viewFile);
        }
        ?>
    </div>
</div>