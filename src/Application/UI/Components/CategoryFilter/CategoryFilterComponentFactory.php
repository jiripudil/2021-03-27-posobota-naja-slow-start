<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\CategoryFilter;

interface CategoryFilterComponentFactory
{
	public function create(): CategoryFilterComponent;
}
