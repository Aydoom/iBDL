<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <?php
            echo $this->form->create("user"); 
            
            echo $this->form->text("login");
            echo $this->form->password("Password");
            
            echo $this->form->end("Enter");
        ?>
        <div class="text-right">
            <?=$this->html->link("Registration on the service", "/user/registrar");?>
        </div>
    </div>
</div>