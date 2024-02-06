<?php
$item = $item ?? null;
$url = $url ?? $item->getDeleteURL();
?>

<td class="cell-t1">
    <div class="buttons inline">
        <a class="button confirm" href="#" rel="<?= $url; ?>"
           title="<?= translator()->trans('general.messages.confirm'); ?>">
            <img src="<?= $this->Url()->image("ico/cancel.png"); ?>" alt=""/>
        </a>
    </div>
</td>
