<?php
    $menuLinks = [
        "/"             => "Главная",
        "/session"      => "Сессии",
        "/report"       => "Отчеты",
        "/group"        => "Группировки",
        "/generation"   => "Генерации",
        "/sensor"       => "Датчики",
        "/setting"      => "Настройки",
        "/user"         => "Пользователи",
        "/trash"        => "Корзина",
        "/user/logout"  => "Выход"
    ];

?>

<!DOCTYPE html>
<html>
<head>
    <?//= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?//= $this->Html->meta('icon') ?>

    <?= $this->html->css('bootstrap.min.css') ?>
    <?= $this->html->css('main.css') ?>

    <?//= $this->fetch('meta') ?>
    <?//= $this->fetch('css') ?>
    <?//= $this->fetch('script') ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row h100">
            <div class="col-lg-2 col-leftbar">
                <ul class="nav nav-pills nav-stacked nav-grey">
                    <?php
                        foreach ($menuLinks as $href => $text) {
                            $r = iBDL\Core\Router::$request;
                            if ($href === $r || $href . "/index" === $r) {
                                $class = ' class="active"';
                                $contentTitle = $text;
                            } else {
                                $class = '';
                            }
                            
                            echo '<li role="presentation"' . $class . '>' .
                                $this->html->link($text, $href) . '</li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-9">
                        <h3><?=$contentTitle?></h3>
                    </div>
                    <div class="col-lg-3">
                        <h4><?=$this->user->getName()?> <small>Log out</small></h4>
                    </div>
                    <div class="row row-header"></div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?=$this->view()?>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</body>
</html>
