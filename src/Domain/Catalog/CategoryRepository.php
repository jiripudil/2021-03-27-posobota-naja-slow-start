<?php

declare(strict_types=1);

namespace NajaSlowStart\Domain\Catalog;

final class CategoryRepository
{
	/** @var Category[] */
	private array $categories;

	public function __construct()
	{
		$this->categories = [
			'traps' => new Category('traps', 'Traps'),
			'disasters' => new Category('disasters', 'Disasters'),
			'trickery' => new Category('trickery', 'Trickery'),
			'contraptions' => new Category('contraptions', 'Contraptions'),
		];
	}

	/**
	 * @return Category[]
	 */
	public function findAll(): array
	{
		return \array_values($this->categories);
	}

	public function getBySlug(string $slug): Category
	{
		return $this->categories[$slug] ?? throw new \Exception('Category not found.');
	}
}
