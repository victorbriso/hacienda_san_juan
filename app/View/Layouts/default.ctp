<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html class="no-js" lang="es">	
	
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hacienda San Juan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://kit.fontawesome.com/be0af648e9.js" crossorigin="anonymous"></script>
	
    
	<?php echo $this->Html->charset('utf-8'); ?>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'foundation',
			'foundation.min',
			'normalize',
			'style',
			'slick',
			'responsive'
		), array('fullBase' => true)); 
		echo $this->Html->script(array(
			'vendor/jquery',
			'vendor/modernizr',
			'all',
			'slick/slick',
			'scripts',			
			'foundation.min'

		));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	
	<?= $this->element('menu'); ?>
	<?= $this->fetch('content'); ?>
	<?= $this->element('footer'); ?>
</body>
</html>
<script>
	$(document).foundation();
</script>
