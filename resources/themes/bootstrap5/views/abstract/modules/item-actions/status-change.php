<?php
$item = $item ?? $this->item;
$statuses = $statuses ?? $this->statuses;
$currentStatus = method_exists($item, 'getStatusObject') ? $item->getStatusObject() : $item->getStatus();
?>
<div class="dropdown">
    <button type="button" class="btn btn-sm btn-<?= $currentStatus->getColorClass(); ?> dropdown-toggle"
            id="changeStatus<?= $item->id; ?>" data-bs-toggle="dropdown" aria-expanded="false"
            style="<?= $currentStatus->getColorCSS(); ?>">
        <?= $currentStatus->getLabel(); ?>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php foreach ($statuses as $status) { ?>
            <?php if ($status->getName() != $currentStatus->getName()) { ?>
                <li>
                    <a href="<?= $item->getChangeStatusURL(['status' => $status->getName()]); ?>"
                       class="dropdown-item">
                        <?= $status->getLabel(); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
