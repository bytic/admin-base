<?= $this->load('/modules/modals/modal_form'); ?>

<?php
echo $this->Stylesheets()->renderRaw();

echo $this->Scripts()->render();
echo $this->Scripts()->renderRaw();

echo $this->Tooltips()->render();

echo $this->GoogleWebFonts();
