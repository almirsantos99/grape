<?php
namespace core;
 
class Route {

	private $routes = [];

	public function init()
	{
		if ($hasRoute = $this->hasRoute($_GET['route'])) {
			$this->runController($_GET['route']);
		} 
	}

	private function runController($controller)
	{
		$controllerAndMethod = $this->parseController($controller);
		require CONTROLLER_PATH . $controllerAndMethod['controller'] . '.php';
		$pedido = new $controllerAndMethod['controller'];
		echo $pedido->{$controllerAndMethod['method']}();
	}

	private function parseController($route)
	{
		$controllerAndMethod = [];
		var_dump($route); exit();

		

		if (!isset($this->routes[$route])) {
			die('erro');	
		}


		$controllerAndMethod = explode('.', $this->routes[$route]);
		return [
			'controller' => !empty($controllerAndMethod[0]) ? $controllerAndMethod[0] : null,
			'method'     => !empty($controllerAndMethod[1]) ? $controllerAndMethod[1] : null
		];
	}

	private function hasRoute($current)
	{
		if (array_key_exists($current, $this->routes)) {
			return true;
		}

		if ($this->RouteHasParam($current)) {
			return true;
		}

		return false;
	}

	private function RouteHasParam($current)
	{
		$route = explode('/', $current);
		if (array_key_exists($route[0], $this->routes) && !empty($route[1])) {
			return true;
		}

		return false;
	}

	public function addRoute($route)
	{
		// TODO: Search better way to do this
		return $this->routes[key($route)] = $route[key($route)];
	}
}
