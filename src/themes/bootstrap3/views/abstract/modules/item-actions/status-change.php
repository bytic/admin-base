<div class="btn-group btn-group-sm" >
    <button type="button" class="btn btn-<?php echo $item->getStatus()->getColorClass(); ?>"
            style="<?php echo $item->getStatus()->getColorCSS(); ?>">
        <?php echo $item->getStatus()->getLabel(); ?>
    </button>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php foreach ($statuses as $status) { ?>
            <?php if ($status->getName() != $item->getStatus()->getName()) { ?>
                <li>
                    <a href="<?php echo $item->getChangeStatusURL(['status' => $status->getName()]); ?>">
                        <?php echo $status->getLabel(); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>