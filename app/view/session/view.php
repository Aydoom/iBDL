<?php
    $session = $this->fetch('session');
    $pages = $this->pagination->create('session');

    $span = function ($uri, $class, $this) {
      
        return $this->html->link(
                '<span class="glyphicon ' . $class . '" aria-hidden="true"></span>',
                "session/" . $uri
            );
    };
?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th class='text-center'>Actions</th>
            </tr>
            <?php foreach($session['file'] as $file) :?>
            <tr>
                <td><?=$file['id']?></td>
                <td><?=$this->html->link($file['name']
                        , '/session/view/' . $file['id'])?></td>
                <td><?=$file['loadDate']?></td>
                <td class='text-center'>
                    <?= $span("update", "glyphicon-pencil", $this)?>
                    <?= $span("#", "glyphicon-eye-close", $this)?>
                    <?= $span("delete", "glyphicon-trash", $this)?>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?=$pages->nav('session')?>
    </div>
</div>

