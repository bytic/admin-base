<?php
$breadcrumbs = $this->get('breadcrumbs');
$breadcrumbs = is_array($breadcrumbs) ? $breadcrumbs : [];
?>
<?php if (count($breadcrumbs) < 1) { ?>
    <?php return; ?>
<?php } ?>

<?php
$firstBreadcrumb = reset($breadcrumbs);
$lastBreadcrumb = end($breadcrumbs);
?>
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb m-0">
        <?php foreach ($breadcrumbs as $item) { ?>
            <?php
            $classes = ['breadcrumb-item'];
            if ($item == $firstBreadcrumb) {
                $classes[] = 'first';
            }
            if ($item == $lastBreadcrumb) {
                $classes[] = 'active';
            }
            ?>
            <li<?php echo $classes ? ' class="' . implode(" ", $classes) . '"' : ''; ?>>
                <?php if ($item != $lastBreadcrumb) { ?>
                    <a href="<?php echo htmlentities($item['url']); ?>" title="<?php echo $item['title']; ?>">
                        <?php echo $item['title']; ?>
                    </a>
                <?php } else { ?>
                    <span><?php echo $item['title']; ?></span>
                <?php } ?>
            </li>
        <?php } ?>
    </ol>
</nav>