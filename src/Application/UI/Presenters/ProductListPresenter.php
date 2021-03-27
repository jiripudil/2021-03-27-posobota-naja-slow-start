<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Presenters;

use NajaSlowStart\Application\UI\Components\CategoryFilter\CategoryFilterComponent;
use NajaSlowStart\Application\UI\Components\CategoryFilter\CategoryFilterComponentFactory;
use NajaSlowStart\Application\UI\Components\Paging\PagingComponent;
use NajaSlowStart\Application\UI\Components\Paging\PagingComponentFactory;
use NajaSlowStart\Domain\Catalog\Product;
use NajaSlowStart\Domain\Catalog\ProductRepository;

final class ProductListPresenter extends BasePresenter
{
	private const PER_PAGE = 2;

	public function __construct(
		private ProductRepository $productRepository,
		private CategoryFilterComponentFactory $categoryFilterComponentFactory,
		private PagingComponentFactory $pagingComponentFactory,
	)
	{
		parent::__construct();
	}

	public function renderDefault(?string $category = null, int $page = 1): void
	{
		$products = $this->productRepository->findAll();

		$category = $this['categoryFilter']->getSelectedCategory();
		if ($category !== null) {
			$products = \array_filter(
				$products,
				static fn(Product $product) => $product->getCategory()->getSlug() === $category->getSlug(),
			);
		}

		$paginator = $this['paging']->getPaginator();
		$paginator->setItemCount(\count($products));
		$paginator->setItemsPerPage(self::PER_PAGE);

		$offset = $paginator->getOffset();
		$products = \array_slice($products, $offset, self::PER_PAGE);

		$this->template->products = $products;
	}

	protected function createComponentCategoryFilter(): CategoryFilterComponent
	{
		$component = $this->categoryFilterComponentFactory->create();
		$component->onFilter[] = function (): void {
			// reset to page 1 after changing filter
			$this['paging']->reset();

			$this->redirect('this');
		};

		return $component;
	}

	protected function createComponentPaging(): PagingComponent
	{
		return $this->pagingComponentFactory->create();
	}
}
