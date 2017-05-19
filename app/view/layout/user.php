<!DOCTYPE html>
<html>
<head>
    <?//= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>

</head>
<body>
    <div class="container-fluid">
        <div class="row h100">
            <div class="col-lg-2 col-leftbar">
                <div class="col-nav-help text-center">
                    <h4>The form of autorization.</h4>
                    <p>Please fill the form to enter in this service.</p>                    
                </div>
            </div>
            <div class="col-lg-10">
                <h3><?=$this->fetch('title')?></h3>
                <hr/>
                <?=$this->view()?>
            </div>
        </div>
    </div>
</body>
</html>
