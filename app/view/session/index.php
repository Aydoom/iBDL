<?php
    $sessions = $this->fetch('sessions');
    $pages = $this->pagination->create('session');
    
    $span = function ($uri, $class, $this) {
      
        return $this->html->link(
                '<span class="glyphicon ' . $class . '" aria-hidden="true"></span>',
                "session/" . $uri
            );
    };
?>

<div class="row">
    <div class="col-lg-2">
        <?=$this->html->link('Создать Сессию', '/session/create',
                ['class' => 'btn btn-default', 'role'=>'button']); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th class='text-center'>Actions</th>
            </tr>
            <?php foreach($sessions as $session) :?>
            <tr>
                <td><?=$session['id']?></td>
                <td><?=$session['name']?></td>
                <td><?=$session['registerDate']?></td>
                <td class='text-center'>
                    <?= $span("update", "glyphicon-pencil", $this)?>
                    <?= $span("#", "glyphicon-eye-close", $this)?>
                    <?= $span("delete", "glyphicon-trash", $this)?>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <?=$pages->nav()?>
    </div>
</div>

