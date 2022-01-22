<?php
/** @var View $this */

use Nip\View;

?>
<div id="page-heading">
    <div class="row-fluid">
        <div class="col-md-8">
            <h4 class="page-title">
                <?php echo $this->title; ?>
            </h4>

            <?php echo $this->controller == 'error' ? '' : $this->Breadcrumbs(); ?>
        </div>
        <div class="col-md-4 page-actions">
            <div class="btn-toolbar" role="toolbar" style="margin-top: 15px;">
                <?php
                $viewFile = "/" . $this->controller . "/modules/header-buttons/" . $this->action;
                if ($this->existPath($viewFile)) {
                    $this->load($viewFile);
                }
                ?>
            </div>
        </div>
    </div>
</div>