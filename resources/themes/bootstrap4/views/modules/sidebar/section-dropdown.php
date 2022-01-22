<?php
$name = isset($name) ? $name : '';
$items = isset($items) ? $items : [];
?>
<li class="nav-header has-sub" style=" ">

    <a href="javascript:"
       data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="navHeaderDropdown" style="font-size: 85%">
        <b class="caret pull-right"></b>
        <?php echo $name; ?>
    </a>

    <ul class="sub-menu" role="menu">
        <?php if (count($items)) { ?>
            <?php foreach ($items as $item) { ?>
                <?php
                $url = is_object($item) ? $item->getURL() : '';
                $name = is_object($item) ? $item->getName() : '';
                ?>
                <li class="">
                    <a class="" href="<?php echo $url; ?>">
                        <?php echo $name; ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</li>