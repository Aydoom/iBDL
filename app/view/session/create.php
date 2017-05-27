<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <?php
            echo $this->form->create("session", false,
                    ['enctype' => 'multipart/form-data']); 
            
            echo $this->form->text("name", 
                    ['label' => 'Login', 'placeholder' => 'Domnin']);
            echo $this->form->file("files[]", ['label' => 'Файлы данных']);
          
            echo $this->form->end("SignUp");
        ?>
    </div>
</div>

