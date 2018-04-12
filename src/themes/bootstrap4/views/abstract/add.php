<div class="row">    
    <div class="col-md-12">
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
                if (!is_file($this->buildPath($viewFile))) {
                    $viewFile = '/abstract/modules/item-form';
                }
                $this->addTab("details", translator()->translate('details'), $viewFile,
                    array("action" => $this->modelManager->getAddURL()), true);

                echo $this->renderTabControls();
                echo $this->renderTabContents();
                ?>
            </div>
        </div>
    </div>
</div>