<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\BasketWidget;

use NajaSlowStart\Domain\Basket\Basket;
use Nette\Application\UI\Control;

final class BasketWidgetComponent extends Control
{
	public function __construct(
		private Basket $basket,
	) {}

	public function render(): void
	{
		$this->template->render(
			__DIR__ . '/BasketWidgetComponent.latte',
			[
				'itemsCount' => $this->basket->countItems(),
				'totalPrice' => $this->basket->getTotalPrice(),
			],
		);
	}
}
