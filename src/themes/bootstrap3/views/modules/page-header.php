<div id="page-heading" style="padding:0 15px;">
    <div class="row">
        <div class="col-md-8">            
            <h2><?php echo $this->title; ?></h2>

            <?php echo $this->controller == 'error' ? '' : $this->Breadcrumbs(); ?>    
        </div>
        <div class="col-md-4">            
            <div class="btn-toolbar" role="toolbar" style="margin-top: 15px;">
                <?php
                    $viewFile = "/".$this->controller."/modules/header-buttons/".$this->action;
                    if (is_file($this->buildPath($viewFile))) {
                        $this->load($viewFile);
                    }
                ?>                   
            </div>
        </div>
    </div>
</div>
