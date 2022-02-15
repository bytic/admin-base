<?php
/** @var View $this */

use Nip\View;

$viewFile = "/" . $this->controller . "/modules/header-buttons/" . $this->action;
?>
<div class="page-header d-flex">
    <div class="flex-grow-1">
        <h1 class="page-title">
            <?php echo $this->title; ?>
        </h1>

        <?= $this->controller == 'error' ? '' : $this->Breadcrumbs(); ?>
    </div>

    <div class="page-actions">
        <?php echo $this->loadIfExists($viewFile); ?>
    </div>
</div>