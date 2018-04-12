<div>   
    <span class="pull-right">
        <?php echo $this->paginator->getCount(); ?> rezultate
    </span>

    <ul class="pagination">
        <li class="<?php echo $this->page <= 1 ? 'disabled' : ''; ?>">
            <?php
            if ($this->page > 1) {
                ?>
                <a href="<?php echo $this->paginator->url($this->page - 1); ?>" title="Inapoi"
                   class="pagination-previous">&laquo;</a>
                <?php
            } else {
                ?>
                <a href="#" class="pagination-previous">&laquo;</a>
                <?php
            }
            ?>
        </li>

        <?php
        if ($this->pages > 7 && $this->page > 2) {
            if ($this->page >= 7) {
                if ($this->interval['min'] > 2) {
                    ?>
                    <li><a href="<?php echo $this->paginator->url(1); ?>"
                           title="Pagina 1 / <?php echo $this->pages; ?>">1</a></li>
                    <?php
                }
                if ($this->interval['min'] > 3) {
                    ?>
                    <li><a href="<?php echo $this->paginator->url(2); ?>"
                           title="Pagina 2 / <?php echo $this->pages; ?>">2</a></li>
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
            <li<?php echo $i == $this->page ? ' class="active"' : ''; ?>><a
                        href="<?php echo $this->paginator->url($i); ?>"
                        title="Pagina <?php echo $i; ?> / <?php echo $this->pages; ?>"><?php echo $i; ?></a></li>
            <?php
        }
        ?>

        <?php
        if ($this->pages > 7 && ($this->page < $this->pages - 1)) {
            if ($this->pages - $this->interval['max'] >= 3) {
                ?>
                <li class="missing disabled"><a href="#">...</a></li>
                <?php
            }
            if ($this->interval['max'] < $this->pages - 1) {
                ?>
                <li><a href="<?php echo $this->paginator->url($this->pages - 1); ?>"
                       title="Pagina <?php echo $this->pages - 1; ?> / <?php echo $this->pages; ?>"><?php echo $this->pages - 1; ?></a>
                </li>
                <?php
            }
            if ($this->interval['max'] < $this->pages) {
                ?>
                <li><a href="<?php echo $this->paginator->url($this->pages); ?>"
                       title="Pagina <?php echo $this->pages; ?> / <?php echo $this->pages; ?>"><?php echo $this->pages; ?></a>
                </li>
                <?php
            }
        }
        ?>
        <li>
            <?php
            if ($this->page < $this->pages) {
                ?>
                <a href="<?php echo $this->paginator->url($this->page + 1); ?>" title="Inainte" class="pagination-next">&raquo;</a>
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