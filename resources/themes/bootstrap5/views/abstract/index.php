<?php

use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsFactory;
use ByTIC\Icons\Icons;
use Nip\Records\AbstractModels\RecordManager;

$tableClasses = $tableClasses ?? null;

$add = $add ?? true;
$addURLParams = $addURLParams ?? [];

$actions = ActionsCollectionsFactory::from($actions ?? []);

if ($add && false === $actions->has(Action::NAME_CREATE)) {
    $action = ActionsFactory::fromArray([
        'type' => ButtonAction::TYPE,
        'name' => Action::NAME_CREATE,
        'label' => $this->modelManager->getLabel('add'),
        'icon' => Icons::plus(),
        'class' => 'add-' . $this->modelManager->getController(),
        'url' => $this->modelManager->getAddURL($addURLParams),
    ]);
    $actions->add($action);
}

$idTable = $idTable ?? '';

/** @var RecordManager $modelManager */
$modelManager = $this->modelManager;
?>

<?= $this->Flash()->render($this->controller); ?>

<?= $this->loadWithFallback(
    "/" . $this->controller . "/modules/page-actions/" . $this->action,
    '/abstract/modules/page-actions',
    ["actions" => $actions]
); ?>

<?php if ($this->fatalError) { ?>
    <div class="message-info message-error">
        <?= $this->fatalError ?>
    </div>
<?php } else { ?>
    <?= $this->loadIfExists("/" . $this->controller . "/modules/index/pre-list"); ?>

    <div class="bg-white">
        <?= $this->load('modules/list', [
            "items" => $this->items,
            "add" => $add,
            "tableClasses" => $tableClasses,
            "addURLParams" => $addURLParams,
            "idTable" => $idTable,
            "manager" => $this->modelManager,
            "controller" => $this->controller,
        ]); ?>
    </div>

    <?= $this->loadIfExists("/" . $this->controller . "/modules/index/post-list"); ?>

    <?= $this->Paginator()->render(); ?>
<?php } ?>
