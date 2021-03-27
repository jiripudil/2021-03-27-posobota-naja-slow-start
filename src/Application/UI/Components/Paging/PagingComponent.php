<?php

declare(strict_types=1);

namespace NajaSlowStart\Application\UI\Components\Paging;

use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;
use Nette\Utils\Paginator;

final class PagingComponent extends Control
{
	#[Persistent]
	public int $page = 1;

	private Paginator $paginator;

	public function __construct()
	{
		$this->paginator = new Paginator();
		$this->onAnchor[] = function (): void {
			$this->paginator->setPage($this->page);
		};
	}

	public function getPaginator(): Paginator
	{
		return $this->paginator;
	}

	public function reset(): void
	{
		$this->page = 1;
		$this->paginator->setPage(1);
	}


	public function render(): void
	{
		$this->template->render(
			__DIR__ . '/PagingComponent.latte',
			[
				'page' => $this->page,
				'paginator' => $this->paginator,
			],
		);
	}
}
