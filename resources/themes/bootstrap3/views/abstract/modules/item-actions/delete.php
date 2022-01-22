<?php
/** @var Record $item */

use Nip\Records\AbstractModels\Record;

$url = $url ?? $item->compileURL('detete');
?>

<form method="post" action="<?php echo $url; ?>"
      onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
    <button type="submit" class="pull-right inline small">
        <img src="<?php echo $this->Url()->image("ico/cancel.png"); ?>" alt=""/>
    </button>
</form>
