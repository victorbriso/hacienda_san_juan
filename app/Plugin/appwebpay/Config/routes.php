<?php
Router::connect('/', array('controller' => 'compras', 'action' => 'index'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
