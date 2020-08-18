<?php echo $this->Flash()->render($this->controller); ?>

<?php
$viewFile = "/" . $this->controller . "/modules/item-form";
if (!$this->existPath($viewFile)) {
    $viewFile = '/abstract/modules/item-form';
}

echo $this->load($viewFile, ["action" => $this->modelManager->getAddURL()]);
