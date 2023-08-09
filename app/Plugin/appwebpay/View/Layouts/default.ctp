<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Transbank Webpay</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<?= $this->Html->css(array(
			'bootstrap.min',
			'landing',
			'mobile'
		)); ?>
		<?= $this->Html->scriptBlock(sprintf("var webroot = '%s';", $this->webroot)); ?>
		<?= $this->Html->scriptBlock(sprintf("var fullwebroot = '%s';", $this->Html->url('/', true))); ?>
		<? $this->Html->script(array(
			'jquery-2.2.4.min',
			'jquery.validate.min',
			'jquery.alphanumeric.pack',
			'landing'
		)); ?>
		<?= $this->fetch('meta'); ?>
		<?= $this->fetch('css'); ?>
		<?= $this->fetch('script'); ?>
	</head>
	<body>
		<div class="container-fluid contenedor">
			<?= $this->fetch('content'); ?>
		</div>
	</body>
</html>
