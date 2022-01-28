<?php
$branding = $this->_adminBaseLayout->branding();
if (false === $branding->hasLogo()) {
    return;
}
?>
<li class="nav-profile">
    <img src="<?= $branding->getLogo(); ?>" class="img-fluid"/>
</li>