<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Presenters;

use NajaSlowStart\Application\UI\Components\BasketWidget\BasketWidgetComponent;
use NajaSlowStart\Application\UI\Components\BasketWidget\BasketWidgetComponentFactory;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

abstract class BasePresenter extends Presenter
{
	#[Inject] public BasketWidgetComponentFactory $basketWidgetComponentFactory;

	protected function createComponentBasketWidget(): BasketWidgetComponent
	{
		return $this->basketWidgetComponentFactory->create();
	}

	protected function beforeRender(): void
	{
		\sleep(1);

		parent::beforeRender();
		$this->redrawControl('title');
		$this->redrawControl('content');
		$this['basketWidget']->redrawControl();
	}
}
