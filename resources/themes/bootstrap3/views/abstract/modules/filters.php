<?php if ($this->existPath("/".$this->controller."/modules/filters")) { ?>
    <form method="get" action="<?php echo $this->modelManager->getURL(); ?>" id="filter-form" class="filters form-vertical well">
        <div class="row">
            <?php echo $this->load("/".$this->controller."/modules/filters"); ?>
        
            <button type="submit" class="btn btn-primary btn-large">
                <span class="glyphicon glyphicon-search glyphicon-white"></span>
                Filter
            </button>
        </div>
    </form>
<?php } ?>