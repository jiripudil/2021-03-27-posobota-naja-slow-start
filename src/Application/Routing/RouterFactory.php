<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\Routing;

use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;

final class RouterFactory
{
	public function create(): Router
	{
		$router = new RouteList('Front');
		$router->addRoute('<presenter>/<action>/<id>', 'Default:default');
		return $router;
	}
}
