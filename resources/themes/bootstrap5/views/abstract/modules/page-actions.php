<?php

use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;

$actions = ActionsCollectionsFactory::from($actions ?? []);
?>

<div class="my-4 d-grid gap-4">
    <?= $this->loadIf(
        $this->existPath("/" . $this->controller . "/modules/filters"),
        '/abstract/modules/panels/filters'
    ); ?>

    <div>
        <?php if ($this->existPath("/" . $this->controller . "/modules/right-buttons")) { ?>
            <div class="right" style="margin-bottom:20px;">
                <?php echo $this->load("/" . $this->controller . "/modules/right-buttons"); ?>
            </div>
        <?php } ?>

        <?php foreach ($actions as $action) { ?>
            <?= $action; ?>
        <?php } ?>
    </div>
</div>
