<?php

declare(strict_types = 1);

use Nette\Configurator;
use Nette\DI\Container;
use Nette\StaticClass;

require_once __DIR__ . '/vendor/autoload.php';

final class Bootstrap
{
	use StaticClass;

	public static function boot(): Container
	{
		$configurator = new Configurator();

		$configurator->setTimeZone('UTC');
		$configurator->setTempDirectory(__DIR__ . '/temp');
		$configurator->enableTracy(__DIR__ . '/log');

		$configurator->addConfig(__DIR__ . '/config/config.neon');
		$configurator->addConfig(__DIR__ . '/config/local.neon');

		$configurator->addParameters([
			'rootDir' => __DIR__,
			'appDir' => __DIR__ . '/src',
			'wwwDir' => __DIR__ . '/public',
		]);

		return $configurator->createContainer();
	}
}
