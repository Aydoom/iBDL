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
			<div class="col-lg-2 col-nav">
				<ul class="nav nav-pills nav-stacked nav-grey">
					<li role="presentation" class="active"><a href="#">Главная</a></li>
					<li role="presentation"><?= $this->html->link("Сессии", "/session/index");?></li>
					<li role="presentation"><?= $this->html->link("Отчеты", "/report/index");?></li>
					<li role="presentation"><?= $this->html->link("Группировки", "/group/index");?></li>
					<li role="presentation"><?= $this->html->link("Генерации", "/generation/index");?></li>
					<li role="presentation"><?= $this->html->link("Датчики", "/sensor/index");?></li>
					<li role="presentation"><?= $this->html->link("Настройки", "/setting/index");?></li>
					<li role="presentation"><?= $this->html->link("Пользователи", "/user/index");?></li>
					<li role="presentation"><a href="#">Выход</a></li>
				</ul>
			</div>
			<div class="col-lg-10">Рабочая область
                <?=$this->view()?>
            </div>
		</div>
	</div>
</body>
</html>
