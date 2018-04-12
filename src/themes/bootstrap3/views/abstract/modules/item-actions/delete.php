<?php
    if (!$url) {
        $url = $item->getDeleteURL();
    }
?>

<form method="post" action="<?php echo $url; ?>"
      onsubmit="return confirm('<?php echo translator()->translate('general.messages.confirm'); ?>');">
    <button type="submit" class="pull-right inline small">
        <img src="<?php echo $this->Url()->image("ico/cancel.png"); ?>" alt="" />
    </button>
</form>
