<?php
$route = new core\Route();
$route->addRoute(['login'        => 'Login.auth']);
$route->addRoute(['pedido'       => 'Pedido.root']);
$route->addRoute(['pedido/lorem' => 'Pedido.lorem']);
$route->addRoute(['pedido/:id'   => 'Pedido.teste']);
// TODO: move hasRoute to init method
$route->init();
