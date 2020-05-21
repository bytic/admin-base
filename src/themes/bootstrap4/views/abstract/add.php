<div class="row">    
    <div class="col-md-12">
        <div class="card panel-inverse">
            <div class="card-header">
                <h4 class="card-title">
                    <?php echo $this->modelManager->getLabel('add'); ?>
                </h4>
            </div>

            <div class="card-body">
                <?php echo $this->Flash()->render($this->controller); ?>

                <?php
                $viewFile = "/" . $this->controller . "/modules/item-form";
                if (!$this->existPath($viewFile)) {
                    $viewFile = '/abstract/modules/item-form';
                }
                $this->addTab("details", translator()->translate('details'), $viewFile,
                    ["action" => $this->modelManager->getAddURL()], true);

                echo $this->renderTabControls();
                echo $this->renderTabContents();
                ?>
            </div>
        </div>
    </div>
</div>