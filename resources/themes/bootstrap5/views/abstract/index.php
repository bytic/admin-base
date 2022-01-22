<?php

use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsFactory;
use ByTIC\Icons\Icons;
use Nip\Records\AbstractModels\RecordManager;

$add = $add ?? true;
$addURLParams = $addURLParams ?? [];

$actions = ActionsCollectionsFactory::from($actions ?? []);

if ($add && false === $actions->has(Action::NAME_CREATE)) {
    $action = ActionsFactory::fromArray([
        'name' => Action::NAME_CREATE,
        'label' => $this->modelManager->getLabel('add'),
        'icon' => Icons::plus(),
        'url' => $this->modelManager->getAddURL($addURLParams),
    ]);
    $actions->add($action);
}

$idTable = $idTable ?? '';

/** @var RecordManager $modelManager */
$modelManager = $this->modelManager;
?>

<?php echo $this->Flash()->render($this->controller); ?>

<?php echo $this->loadWithFallback(
    $this->existPath("/" . $this->controller . "/modules/page-actions/" . $this->action),
    '/abstract/modules/page-actions',
    ["actions" => $actions]
); ?>

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
