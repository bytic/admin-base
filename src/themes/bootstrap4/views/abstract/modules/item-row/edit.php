<?php
    if (!$url) {
        $url = $item->getURL();
    }
?>

<td class="cell-t1">
    <div class="buttons inline">
        <a href="<?php echo $url; ?>" class="right inline small">
            <img src="<?php echo $this->Url()->image("ico/pencil.png"); ?>" alt="" />
        </a>
    </div>
</td>
