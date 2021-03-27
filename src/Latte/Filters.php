<?php

declare(strict_types=1);

namespace NajaSlowStart\Latte;

use Brick\Money\Money;

final class Filters
{
	public static function formatMoney(Money $money): string
	{
		return $money->formatTo('en_US');
	}
}
