<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\BasketWidget;

interface BasketWidgetComponentFactory
{
	public function create(): BasketWidgetComponent;
}
