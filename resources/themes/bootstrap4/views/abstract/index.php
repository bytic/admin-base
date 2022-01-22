<?php

use ByTIC\Common\Records\Records;

$add = isset($add) ? $add : true;
$addURLParams = isset($addURLParams) ? $addURLParams : [];
$idTable = isset($idTable) ? $idTable : '';

/** @var Records $modelManager */
$modelManager = $this->modelManager;
?>

<?php echo $this->Flash()->render($this->controller); ?>

<?php echo $this->loadIf(
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

    <?php if ($add) { ?>
        <a href="<?php echo $this->modelManager->getAddURL($addURLParams); ?>"
           class="btn btn-success add-<?php echo $this->modelManager->getController(); ?>"
           title="<?php echo $this->modelManager->getLabel('add'); ?>">
            <span class="glyphicon glyphicon-plus glyphicon-white"></span>
            <?php echo $this->modelManager->getLabel('add'); ?>
        </a>
    <?php } ?>
</p>

<?php
$viewFile = "/" . $this->controller . "/modules/index/pre-list";
if ($this->existPath(($viewFile))) {
    $this->load($viewFile);
}
?>

<?php if ($this->fatalError) { ?>
    <div class="message-info message-error">
        <?php echo $this->fatalError ?>
    </div>
<?php } else { ?>

    <?php echo $this->load('modules/list', [
        "items" => $this->items,
        "add" => $add,
        "tableClasses" => (isset($tableClasses) ? $tableClasses : false),
        "addURLParams" => $addURLParams,
        "idTable" => $idTable,
        "manager" => $this->modelManager,
        "controller" => $this->controller,
    ]); ?>

    <?php echo $this->Paginator()->render(); ?>

    <?php
    $viewFile = "/" . $this->controller . "/modules/index/post-list";
    if ($this->existPath($viewFile)) {
        $this->load($viewFile);
    }
    ?>
<?php } ?>
