<!DOCTYPE html>
<html>
<head>
    <?//= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?//= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('main.css') ?>

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
					<li role="presentation"><?= $this->Html->link("Данные", "home/data");?></li>
					<li role="presentation"><a href="#">Загрузка</a></li>
					<li role="presentation"><a href="#">Настройки</a></li>
					<li role="presentation"><a href="#">Пользователи</a></li>
					<li role="presentation"><a href="#">Выход</a></li>
				</ul>
			</div>
			<div class="col-lg-10">Рабочая область</div>
		</div>
	</div>
</body>
</html>
