<?php
$logoUrl = function_exists('logoUrl') ? logoUrl('logo-white.png') : asset('/images/logos/logo-white.png');
?>
<li class="nav-profile">
    <img src="<?php echo $logoUrl; ?>" class="img-fluid"/>
    <!--    <div class="image"></div>-->
</li>