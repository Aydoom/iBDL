<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <?php
            echo $this->form->create("user"); 
            
            echo $this->form->text("name", 
                    ['label' => 'Login', 'placeholder' => 'Domnin']);
            echo $this->form->text("username",
                    ['label' => 'Your Name', 'placeholder' => 'Павел Д.']);
            echo $this->form->password("password", ['label' => 'Password']);
            echo $this->form->password("repeatPassword", ['label' => 'Repeat Password']);
            echo $this->form->text("key", ['label' => 'Invitation key']);
           
            echo $this->form->end("SignUp");
        ?>
        <div class="text-right">
            <?=$this->html->link("I have a login", "/user/login");?>
        </div>
    </div>
</div>
