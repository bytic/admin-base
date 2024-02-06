<?php
$item = $item ?? null;
?>
<tr id="item-<?= $item->id; ?>">
    <td>
        <a href="<?= $item->getURL(); ?>" title="<?= $item->name; ?>" class="ico ico-folder">
            <?= $item->name; ?>
        </a>
    </td>
    <?= $this->load("/models/modules/item-row/delete", ["item" => $item]); ?>
</tr>