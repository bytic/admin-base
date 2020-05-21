<?php
$resultsCount = $this->paginator->getCount();
$currentPage = $this->page;
$pagesCount = $this->pages;
?>
<nav aria-label="Items navigation">
    <span class="pull-right">
        <?php echo $resultsCount; ?> rezultate
    </span>

    <ul class="pagination">
        <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
            <?php $prevUrl = ($currentPage > 1) ? $this->paginator->url($currentPage - 1) : '#'; ?>

            <a href="<?php echo $prevUrl; ?>" title="Inapoi"
               class="page-link pagination-previous">&laquo;</a>
        </li>

        <?php
        if ($pagesCount > 7 && $currentPage > 2) {
            if ($currentPage >= 7) {
                if ($this->interval['min'] > 2) {
                    ?>
                    <li class="page-item"><a href="<?php echo $this->paginator->url(1); ?>"
                                             title="Pagina 1 / <?php echo $pagesCount; ?>">1</a></li>
                    <?php
                }
                if ($this->interval['min'] > 3) {
                    ?>
                    <li class="page-item"><a href="<?php echo $this->paginator->url(2); ?>"
                                             title="Pagina 2 / <?php echo $pagesCount; ?>">2</a></li>
                    <?php
                }
            }
            if ($this->interval['min'] > 3) {
                ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php
            }
        }
        ?>

        <?php
        for ($i = $this->interval['min']; $i <= $this->interval['max']; $i++) {
            ?>
            <li<?php echo $i == $currentPage ? ' class="active"' : ''; ?>>
                <a class="page-link" href="<?php echo $this->paginator->url($i); ?>"
                   title="Pagina <?php echo $i; ?> / <?php echo $pagesCount; ?>"><?php echo $i; ?></a>
            </li>
            <?php
        }
        ?>

        <?php
        if ($pagesCount > 7 && ($currentPage < $pagesCount - 1)) {
            if ($pagesCount - $this->interval['max'] >= 3) {
                ?>
                <li class="page-item missing disabled"><a class="page-link" href="#">...</a></li>
                <?php
            }
            if ($this->interval['max'] < $pagesCount - 1) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $this->paginator->url($pagesCount - 1); ?>"
                       title="Pagina <?php echo $pagesCount - 1; ?> / <?php echo $pagesCount; ?>"><?php echo $pagesCount - 1; ?></a>
                </li>
                <?php
            }
            if ($this->interval['max'] < $pagesCount) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $this->paginator->url($pagesCount); ?>"
                       title="Pagina <?php echo $pagesCount; ?> / <?php echo $pagesCount; ?>"><?php echo $pagesCount; ?></a>
                </li>
                <?php
            }
        }
        ?>
        <li class="page-item">
            <?php
            if ($currentPage < $pagesCount) {
                ?>
                <a href="<?php echo $this->paginator->url($currentPage + 1); ?>" title="Inainte"
                   class="page-link pagination-next">&raquo;</a>
                <?php
            } else {
                ?>
                <a href="#" class="page-link pagination-next disabled">&raquo;</a>
                <?php
            }
            ?>
        </li>
    </ul>
</nav>