<?php

declare(strict_types=1);

namespace NajaSlowStart\Domain\Catalog;

use Nextras\Orm\Entity\Entity;

final class Category
{
	public function __construct(
		private string $slug,
		private string $name,
	) {}

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function getName(): string
	{
		return $this->name;
	}
}
