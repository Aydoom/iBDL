<div class="row">
    <div class="col-lg-4 col-lg-offset-1">
        <?php
            echo $this->form->create("user"); 
            
            echo $this->form->text("login");
            echo $this->form->password("Password");
            
            echo $this->form->end("Enter");
        ?>
    </div>
</div>