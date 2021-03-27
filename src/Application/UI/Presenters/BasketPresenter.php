<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Presenters;

use NajaSlowStart\Domain\Basket\Basket;

final class BasketPresenter extends BasePresenter
{
	public function __construct(
		private Basket $basket,
	)
	{
		parent::__construct();
	}

	public function renderDefault(): void
	{
		$this->template->totalPrice = $this->basket->getTotalPrice();
		$this->template->items = $this->basket->getItems();
	}
}
