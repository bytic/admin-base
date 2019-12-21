<?php
$usersManager = \Nip\Records\Locator\ModelLocator::get('users');
?>
<div class="page-container brand-header">
    <img src="<?php echo asset('/images/logo.png'); ?>" style="width:100%"/>
</div>

<div id="form-container">
    <div class="page-container">
        <form action="" method="POST" class="margin-bottom-0">
            <input type="hidden" name="trigger" value="login"/>
            <?php if ($this->error) { ?>
                <div class="alert alert-danger">
                    <?php echo $usersManager->getMessage('form.login.error'); ?>:
                </div>
            <?php } ?>

            <div class="form-group m-b-20">
                <input class="form-control input-lg" name="email" value="<?php echo $this->user->email; ?>"
                       placeholder="<?php echo translator()->translate('email'); ?>:" type="text">
            </div>
            <div class="form-group m-b-20">
                <input class="form-control input-lg" type="password" name="password"
                       placeholder="<?php echo translator()->translate('password'); ?>:">
            </div>
            <div class="login-buttons">
                <button type="submit" class="btn btn-success btn-block btn-lg">
                    <?php echo translator()->translate('login'); ?>
                </button>
            </div>
        </form>
    </div>
</div>
