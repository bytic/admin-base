<?php echo $this->Flash()->render($this->controller); ?>

<?php
$viewFile = "/" . $this->controller . "/modules/item-form";
if (!$this->existPath($viewFile)) {
    $viewFile = '/abstract/modules/item-form';
}
?>

<div class="row">
    <div class="col-xl-8 col-lg-10">
        <?php echo $this->load($viewFile, ["action" => $this->modelManager->getAddURL()]); ?>
    </div>
</div>
