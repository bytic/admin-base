<?php

use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;

$actions = ActionsCollectionsFactory::from($actions ?? []);
?>
<?= $this->loadIf(
    $this->existPath("/" . $this->controller . "/modules/filters"),
    '/abstract/modules/panels/filters'
); ?>

    <div class="mt-3"></div>
    <p>
<?php if ($this->existPath("/" . $this->controller . "/modules/right-buttons")) { ?>
    <div class="right" style="margin-bottom:20px;">
        <?php echo $this->load("/" . $this->controller . "/modules/right-buttons"); ?>
    </div>
<?php } ?>

<?php foreach ($actions as $action) { ?>
    <?= $this->load("/admin-actions/action", ['item' => $action]); ?>
<?php } ?>
    </p>

<?php
$viewFile = "/" . $this->controller . "/modules/index/pre-list";
if ($this->existPath(($viewFile))) {
    $this->load($viewFile);
}
?>