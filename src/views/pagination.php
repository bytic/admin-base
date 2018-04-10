<?php
$resultsCount = $this->paginator->getCount();
$currentPage = $this->page;
$pagesCount = $this->pages;
?>
<div>
    <span class="pull-right">
        <?php echo $resultsCount; ?> rezultate
    </span>

    <ul class="pagination">
        <li class="<?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
            <?php
            if ($currentPage > 1) {
                ?>
                <a href="<?php echo $this->paginator->url($currentPage - 1); ?>" title="Inapoi" class="pagination-previous">&laquo;</a>
                <?php
            } else {
                ?>
                <a href="#" class="pagination-previous">&laquo;</a>
                <?php
            }
            ?>
        </li>

        <?php
        if ($pagesCount > 7 && $currentPage > 2) {
            if ($currentPage >= 7) {
                if ($this->interval['min'] > 2) {
                    ?>
                    <li><a href="<?php echo $this->paginator->url(1); ?>" title="Pagina 1 / <?php echo $pagesCount; ?>">1</a></li>
                    <?php
                }
                if ($this->interval['min'] > 3) {
                    ?>
                    <li><a href="<?php echo $this->paginator->url(2); ?>" title="Pagina 2 / <?php echo $pagesCount; ?>">2</a></li>
                    <?php
                }
            }
            if ($this->interval['min'] > 3) {
                ?>
                <li class="missing disabled"><a href="#">...</a></li>
                <?php
            }
        }
        ?>

        <?php
        for ($i = $this->interval['min']; $i <= $this->interval['max']; $i++) {
            ?>
            <li<?php echo $i == $currentPage ? ' class="active"' : ''; ?>><a href="<?php echo $this->paginator->url($i); ?>" title="Pagina <?php echo $i; ?> / <?php echo $pagesCount; ?>"><?php echo $i; ?></a></li>
            <?php
        }
        ?>

        <?php
        if ($pagesCount > 7 && ($currentPage < $pagesCount - 1)) {
            if ($pagesCount - $this->interval['max'] >= 3) {
                ?>
                <li class="missing disabled"><a href="#">...</a></li>
                <?php
            }
            if ($this->interval['max'] < $pagesCount - 1) {
                ?>
                <li><a href="<?php echo $this->paginator->url($pagesCount - 1); ?>" title="Pagina <?php echo $pagesCount - 1; ?> / <?php echo $pagesCount; ?>"><?php echo $pagesCount - 1; ?></a></li>
                <?php
            }
            if ($this->interval['max'] < $pagesCount) {
                ?>
                <li><a href="<?php echo $this->paginator->url($pagesCount); ?>" title="Pagina <?php echo $pagesCount; ?> / <?php echo $pagesCount; ?>"><?php echo $pagesCount; ?></a></li>
                <?php
            }
        }
        ?>
        <li>
            <?php
            if ($currentPage < $pagesCount) {
                ?>
                <a href="<?php echo $this->paginator->url($currentPage + 1); ?>" title="Inainte" class="pagination-next">&raquo;</a>
                <?php
            } else {
                ?>
                <a href="#" class="pagination-next disabled">&raquo;</a>
                <?php
            }
            ?>
        </li>
    </ul>
</div>