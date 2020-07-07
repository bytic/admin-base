<?php

$this->TinyMCE()->setBase(asset('/scripts/tinymce'));
$this->TinyMCE()->init();

echo $this->Stylesheets()->renderRaw();

echo $this->Scripts()->render();
echo $this->Scripts()->renderRaw();

echo $this->Tooltips()->render();

echo $this->GoogleWebFonts();
