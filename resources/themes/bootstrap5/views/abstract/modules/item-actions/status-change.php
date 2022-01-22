<div class="dropdown">
    <button type="button" class="btn btn-sm btn-<?php echo $item->getStatus()->getColorClass(); ?> dropdown-toggle"
            id="changeStatus<?= $item->id; ?>" data-bs-toggle="dropdown" aria-expanded="false"
            style="<?php echo $item->getStatus()->getColorCSS(); ?>">
        <?php echo $item->getStatus()->getLabel(); ?>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php foreach ($statuses as $status) { ?>
            <?php if ($status->getName() != $item->getStatus()->getName()) { ?>
                <li>
                    <a href="<?php echo $item->getChangeStatusURL(['status' => $status->getName()]); ?>"
                       class="dropdown-item">
                        <?php echo $status->getLabel(); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
