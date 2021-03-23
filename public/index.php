<?php

declare(strict_types = 1);

use Nette\Application\Application;

require_once __DIR__ . '/../bootstrap.php';

$container = Bootstrap::boot();
$application = $container->getByType(Application::class);
$application->run();
