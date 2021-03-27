<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Presenters;

use NajaSlowStart\Application\UI\Components\AddToBasketButton\AddToBasketButtonComponent;
use NajaSlowStart\Application\UI\Components\AddToBasketButton\AddToBasketButtonComponentFactory;
use NajaSlowStart\Domain\Catalog\Product;
use NajaSlowStart\Domain\Catalog\ProductRepository;

final class ProductDetailPresenter extends BasePresenter
{
	private Product $product;

	public function __construct(
		private ProductRepository $productRepository,
		private AddToBasketButtonComponentFactory $addToBasketButtonComponentFactory,
	)
	{
		parent::__construct();
	}

	public function actionDefault(int $id): void
	{
		try {
			$this->product = $this->productRepository->getById($id);
		} catch (\Exception) {
			$this->error();
		}
	}

	public function renderDefault(): void
	{
		$this->template->product = $this->product;
	}

	protected function createComponentAddToBasket(): AddToBasketButtonComponent
	{
		$component = $this->addToBasketButtonComponentFactory->create($this->product);
		$component->onChange[] = function (): void {
			$this->payload->postGet = true;
			$this->payload->url = $this->link('this');
		};

		return $component;
	}
}
