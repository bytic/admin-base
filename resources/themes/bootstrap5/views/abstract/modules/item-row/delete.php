<?php

use ByTIC\Icons\Icons;

if (!$url) {
    $url = $item->getDeleteURL();
}
?>

<td class="cell-t1" align="right">
    <div class="buttons inline">
        <form method="post" action="<?php echo $url; ?>"
              onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
            <button type="submit" class="right inline btn btn-danger btn-flat btn-xs">
                <?= Icons::remove(); ?>
            </button>
        </form>
    </div>
</td>
