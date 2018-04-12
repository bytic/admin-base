<?php
/** @var array $breadcrumbs */
$breadcrumbs = isset($this->breadcrumbs) ? $this->breadcrumbs : false;
?>
<?php if ($breadcrumbs) { ?>
    <?php $firstCrumb = reset($breadcrumbs); ?>
    <?php $lastCrumb = end($breadcrumbs); ?>
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <?php
            foreach ($breadcrumbs as $item) {
                $classes = [];
                if ($item == $firstCrumb) {
                    $classes[] = 'first';
                }
                if ($item == $lastCrumb) {
                    $classes[] = 'active';
                }
                ?>
                <li<?php echo $classes ? ' class="' . implode(" ", $classes) . '"' : ''; ?>>
                    <?php if ($item != $lastCrumb) { ?>
                        <a href="<?php echo htmlentities($item['url']); ?>"
                           title="<?php echo $item['title']; ?>">
                            <?php echo $this->Strings()->limitWords($item['title'], 5); ?>
                        </a>
                    <?php } else { ?>
                        <span>
                            <?php echo $this->Strings()->limitWords($item['title'], 5); ?>
                        </span>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>