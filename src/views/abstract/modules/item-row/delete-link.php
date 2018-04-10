<?php
    if (!$url) {
        $url = $item->getDeleteURL();
    }
?>

<td class="cell-t1">
    <div class="buttons inline">
        <a class="button confirm" href="#" rel="<?php echo $url; ?>"
           title="<?php echo translator()->translate('general.messages.confirm'); ?>">
            <img src="<?php echo $this->Url()->image("ico/cancel.png"); ?>" alt="" />
        </a>
    </div>
</td>
