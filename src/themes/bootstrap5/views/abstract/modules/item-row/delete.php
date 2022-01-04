<?php
if (!$url) {
    $url = $item->getDeleteURL();
}
?>

<td class="cell-t1">
    <div class="buttons inline">
        <form method="post" action="<?php echo $url; ?>"
              onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
            <button type="submit" class="right inline btn btn-danger btn-xs">
                <i class="icon-remove icon-white"></i>
            </button>
        </form>
    </div>
</td>
