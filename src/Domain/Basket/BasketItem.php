<?php

declare(strict_types=1);

namespace NajaSlowStart\Domain\Basket;

use Brick\Math\BigInteger;
use NajaSlowStart\Domain\Catalog\Product;

final class BasketItem
{
	public function __construct(
		public Product $product,
		public BigInteger $amount,
	) {}
}
