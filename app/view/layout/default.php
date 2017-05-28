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
                        $r = iBDL\Core\Router::$request;
                        $cat = implode("/", array_slice(explode("/", $r), 0, 2));
                        foreach ($menuLinks as $href => $text) {
                            if ($href === $r || $href === $cat) {
                                $class = ' class="active"';
                                $contentTitle = $text;
                                $link = $this->html->block('p', $text);
                            } else {
                                $class = '';
                                $link = $this->html->link($text, $href);
                            }
                            
                            echo '<li role="presentation"' . $class . '>' .
                                $link . '</li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-9">
                        <h3><?=$this->fetch('title')?></h3>
                    </div>
                    <div class="col-lg-3">
                        <h4><?=$this->user->getName()?></h4>
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
