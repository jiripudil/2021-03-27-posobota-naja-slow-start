<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\CategoryFilter;

use NajaSlowStart\Domain\Catalog\Category;
use NajaSlowStart\Domain\Catalog\CategoryRepository;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

final class CategoryFilterComponent extends Control
{
	#[Persistent]
	public ?string $category = null;

	private ?Category $selectedCategory = null;

	/** @var callable[] */
	public array $onFilter = [];

	/** @var Category[] */
	private array $allCategories;

	public function __construct(
		private CategoryRepository $categoryRepository,
	)
	{
		$this->allCategories = $this->categoryRepository->findAll();
		$this->onAnchor[] = function (): void {
			$presenter = $this->getPresenter();
			\assert($presenter !== null);

			if ($this->category !== null) {
				$this->selectedCategory = $this->categoryRepository->getBySlug($this->category);
			}

			$this['form-category']->setDefaultValue($this->category);
		};
	}

	public function getSelectedCategory(): ?Category
	{
		return $this->selectedCategory;
	}

	public function render(): void
	{
		$this->template->render(__DIR__ . '/CategoryFilterComponent.latte');
	}

	protected function createComponentForm(): Form
	{
		$form = new Form();

		$items = [];
		foreach ($this->allCategories as $category) {
			$items[$category->getSlug()] = $category->getName();
		}

		$form->addSelect('category', 'Filter by category:', $items)
			->setPrompt('All products');

		$form->addSubmit('filter', 'Filter');
		$form->onSuccess[] = function ($form, $values): void {
			$category = $values->category;
			$this->selectedCategory = $category !== null
				? $this->categoryRepository->getBySlug($category)
				: null;

			$this->category = $category;
			$this->onFilter($this->selectedCategory);
		};

		return $form;
	}
}
