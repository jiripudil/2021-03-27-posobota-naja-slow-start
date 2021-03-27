<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\AddToBasketButton;

use NajaSlowStart\Domain\Catalog\Product;

interface AddToBasketButtonComponentFactory
{
	public function create(Product $product): AddToBasketButtonComponent;
}
