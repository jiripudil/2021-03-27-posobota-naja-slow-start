<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\Paging;

interface PagingComponentFactory
{
	public function create(): PagingComponent;
}
