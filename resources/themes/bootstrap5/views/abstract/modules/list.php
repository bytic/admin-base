<?php

/** @var RecordManager $manager */

use Nip\Records\RecordManager;

$tableClasses = $tableClasses ?? 'table table-striped table-bordered';
$idTable = $idTable ?? '';
$controller = $controller ?? '';
$items = $items ?? [];
?>
<?php if (count($items) < 1) { ?>
    <?= $this->Messages()->info($manager->getMessage('dnx')); ?>
    <?php return; ?>
<?php } ?>

<table id="<?= $idTable; ?>"
       class="<?= $tableClasses; ?> <?php echo $manager->getController(); ?>">
    <?php echo $this->load("/" . $controller . "/modules/table-header"); ?>
    <tbody>

    <?php //$keys = array_keys($items); ?>
    <?php //$fKey = reset($keys); ?>
    <?php //$lKey = end($keys); ?>
    <?php foreach ($items as $key => $item) { ?>
        <?= $this->load("/" . $controller . "/modules/item-row", [
            //   "isFirst" => $key == $fKey ,
            // "isLast" => $key == $lKey ,
            "item" => $item,
        ]);
        ?>
    <?php } ?>
    </tbody>
</table>
