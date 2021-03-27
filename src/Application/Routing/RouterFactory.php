<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\Routing;

use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;

final class RouterFactory
{
	public function create(): Router
	{
		$router = new RouteList();

		$router->addRoute('products[/<categoryFilter-category \D+>][/<paging-page \d+>]', 'ProductList:default');
		$router->addRoute('product[/<id \d+>]', 'ProductDetail:default');
		$router->addRoute('basket', 'Basket:default');
		$router->addRoute('/', 'ProductList:default', Router::ONE_WAY);

		return $router;
	}
}
