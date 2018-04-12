<?php
    if (!$url) {
        $url = $item->getURL();
    }
?>

<td>    
    <a href="<?php echo $url; ?>" class="pull-right btn btn-xs btn-info">
        <span class="glyphicon glyphicon-pencil"></span>
    </a>
</td>
