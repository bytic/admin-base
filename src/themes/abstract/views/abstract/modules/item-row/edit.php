<?php
$url = $url ?? isset($item) ? $item->getURL() : '#';
?>

<td class="cell-t1">
    <a href="<?php echo $url; ?>" class="btn btn-xs btn-info">
        <i class="far fa-edit"></i>
    </a>
</td>
