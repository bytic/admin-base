<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?php echo $this->modelManager->getLabel('add'); ?>
        </h4>
    </div>

    <div class="panel-body">
        <?php echo $this->Flash()->render($this->controller); ?>

        <?php
        $viewFile = "/" . $this->controller . "/modules/item-form";
        if (!$this->existPath($viewFile)) {
            $viewFile = '/abstract/modules/item-form';
        }
        $this->load($viewFile, ["action" => $this->modelManager->getAddURL()]);
        ?>
    </div>
</div>