<?php
$add = isset($add) ? $add : true;
$addURLParams = isset($addURLParams) ? $addURLParams : [];
$idTable = isset($idTable) ? $idTable : '';
?>

<?php echo $this->Flash()->render($this->controller); ?>

<?php if ($this->existPath("/" . $this->controller . "/modules/filters")) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <?php echo translator()->translate('filters'); ?>
                    </h4>
                </div>

                <div class="panel-body">
                    <form method="get" action="<?php echo $this->modelManager->getURL(); ?>" id="filter-form"
                          class="filters">
                        <div class="row">
                            <?php echo $this->load("/" . $this->controller . "/modules/filters"); ?>

                            <button type="submit" class="btn btn-primary btn-large">
                                <span class="glyphicon glyphicon-search glyphicon-white"></span>
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

    <div class="btn-group" style="overflow: hidden;margin-bottom: 30px">
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
    </div>

<?php
$viewFile = "/" . $this->controller . "/modules/index/pre-list";
if ($this->existPath($viewFile)) {
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
        "add" => (isset($add) ? $add : true),
        "tableClasses" => (isset($tableClasses) ? $tableClasses : false),
        "addURLParams" => $addURLParams,
        "idTable" => $idTable,
        "manager" => $this->modelManager,
        "controller" => $this->controller
    ]); ?>

    <?php echo $this->Paginator()->render(); ?>

    <?php
    $viewFile = "/" . $this->controller . "/modules/index/post-list";
    if ($this->existPath($viewFile)) {
        $this->load($viewFile);
    }
    ?>
<?php } ?>