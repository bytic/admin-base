<div class="btn-group btn-group-sm" >
    <button type="button" class="btn btn-sm btn-<?php echo $item->getStatus()->getColorClass(); ?>"
            style="<?php echo $item->getStatus()->getColorCSS(); ?>">
        <?php echo $item->getStatus()->getLabel(); ?>
    </button>
    <div class="btn-group" role="group">
        <button type="button" class="btn  btn-sm btn-default dropdown-toggle btn-<?php echo $item->getStatus()->getColorClass(); ?>"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                id="btnGroupDrop<?php echo $item->id ?>-status" >
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop<?php echo $item->id ?>-status">
            <?php foreach ($statuses as $status) { ?>
                <?php if ($status->getName() != $item->getStatus()->getName()) { ?>
                    <a href="<?php echo $item->getChangeStatusURL(['status' => $status->getName()]); ?>" class="dropdown-item">
                        <?php echo $status->getLabel(); ?>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
