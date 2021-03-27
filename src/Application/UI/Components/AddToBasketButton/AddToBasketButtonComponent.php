<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\AddToBasketButton;

use NajaSlowStart\Domain\Basket\Basket;
use NajaSlowStart\Domain\Catalog\Product;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

final class AddToBasketButtonComponent extends Control
{
	/** @var callable[] */
	public array $onChange = [];

	public function __construct(
		private Product $product,
		private Basket $basket,
	) {}

	public function render(): void
	{
		$basketItem = $this->basket->getItem($this->product);
		$this->template->render(
			__DIR__ . '/AddToBasketButtonComponent.latte',
			[
				'item' => $basketItem,
			],
		);
	}

	public function handleAdd(): void
	{
		$this->basket->add($this->product);
		$this->onChange();
	}

	protected function createComponentForm(): Form
	{
		$form = new Form();

		$subtract = $form->addSubmit('subtract', '–');
		$subtract->onClick[] = function (): void {
			$this->basket->subtract($this->product);
			$this->onChange();
		};

		$add = $form->addSubmit('add', '+');
		$add->onClick[] = function (): void {
			$this->basket->add($this->product);
			$this->onChange();
		};

		return $form;
	}
}
