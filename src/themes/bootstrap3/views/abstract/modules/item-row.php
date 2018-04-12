<tr id="item-<?php echo $item->id; ?>">
    <td><a href="<?php echo $item->getURL(); ?>" title="<?php echo $item->name; ?>" class="ico ico-folder"><?php echo $item->name; ?></a></td>
    <?php echo $this->load("/models/modules/item-row/delete", array("item" => $item)); ?>
</tr>