<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <?php
            echo $this->form->create("session", false,
                    ['enctype' => 'multipart/form-data']); 
            
            echo $this->form->text("name", 
                    ['label' => 'Имя сессии:', 'placeholder' => 'Климат камера IOQ']);
            echo $this->form->file("files[]", 
                    ['label' => 'Выберитк файлы данных с датчиков:', 'multiple']);
            echo "<br/><br/>";
            echo $this->form->end("Создать");
        ?>
        <div class="text-right">
            <?=$this->html->link("Clear form", "#");?>
        </div>
    </div>
</div>

