<?php if (count($items) > 0) { ?>
    <?php $tableClasses = $tableClasses ? $tableClasses : 'table table-striped table-bordered'; ?>
    <table id="<?php echo $idTable ? $idTable : ''; ?>" class="<?php echo $tableClasses; ?> <?php echo $manager->getController(); ?>" cellspacing="0" cellpadding="0">
        <?php echo $this->load("/".$controller."/modules/table-header"); ?>
        <tbody>

        <?php //$keys = array_keys($items); ?>
        <?php //$fKey = reset($keys); ?>
        <?php //$lKey = end($keys); ?>
        <?php foreach ($items as $key=>$item) { ?>
            <?php
                echo $this->load("/".$controller."/modules/item-row", array(
                 //   "isFirst" => $key == $fKey ,
                   // "isLast" => $key == $lKey ,
                    "item" => $item,
                    ));
            ?>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <?php echo $this->Messages()->info($manager->getMessage('dnx')); ?>
<?php } ?>
