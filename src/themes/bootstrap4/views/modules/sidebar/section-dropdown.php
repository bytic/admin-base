<?php
$name = isset($name) ? $name : '';
$items = isset($items) ? $items : [];
?>
<li class="nav-header" style="border-top:1px solid #fff; background: rgba(0,0,0,0.4)">
    <div class="dropdown">
        <?php echo $this->_event->getName(); ?>

        <button type="button" class="btn btn-default btn-xs dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            &nbsp;
        </button>
        <div class="dropdown-menu" role="menu">
            <?php if (count($items)) { ?>
                <?php foreach ($items as $item) { ?>
                    <?php
                    $url = is_object($item) ? $item->getURL() : '';
                    $name = is_object($item) ? $item->getName() : '';
                    ?>
                    <a class="dropdown-item" href="<?php echo $url; ?>">
                        <?php echo $name; ?>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</li>