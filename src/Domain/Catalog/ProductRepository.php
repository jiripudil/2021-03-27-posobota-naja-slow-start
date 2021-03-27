<?php

declare(strict_types=1);

namespace NajaSlowStart\Domain\Catalog;

use Brick\Money\Money;
use function array_values;

final class ProductRepository
{
	/** @var Product[] */
	private array $products;

	public function __construct()
	{
		$this->products = [
			1 => new Product(1, new Category('traps', 'Traps'), 'Dehydrated Boulders', 'Just add water', 'https://i.pinimg.com/236x/c6/c2/5e/c6c25e4da145d94c288dd3987bf125f4--acme-corporation-product-catalog.jpg', Money::of(99.99, 'USD')),
			2 => new Product(2, new Category('traps', 'Traps'), 'Explosive Tennis Balls', 'Tickle your friends! Surprise your opponent!', 'https://upload.wikimedia.org/wikipedia/en/8/84/Box_of_%22ACME_EXPLOSIVE_TENNIS_BALLS%22_%28screencap%29.jpg', Money::of(29.99, 'USD')),
			3 => new Product(3, new Category('disasters', 'Disasters'), 'DIY Tornado Kit', 'Seed your own tornados', 'data:image/jpeg;base64,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', Money::of(169.99, 'USD')),
			4 => new Product(4, new Category('traps', 'Traps'), 'Giant Rubber Band', 'For tripping road-runners', 'http://cdn.collider.com/wp-content/uploads/acme_giant_rubber_band.jpg', Money::of(49.99, 'USD')),
			5 => new Product(5, new Category('disasters', 'Disasters'), 'Earthquake Pills', 'Why wait? Make your own earthquakes!', 'data:image/jpeg;base64,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', Money::of(129.99, 'USD')),
			6 => new Product(6, new Category('contraptions', 'Contraptions'), 'Rocket-powered Roller Skates', 'Faster than a road-runner', 'https://66.media.tumblr.com/9341e0c3ecc551331e07c3d4ea8159cb/tumblr_numd8r42ov1skqw0co1_500.jpg', Money::of(59.99, 'USD')),
			7 => new Product(7, new Category('contraptions', 'Contraptions'), 'Disintegrating Pistol', 'Disintegrates like a charm', 'https://farm1.staticflickr.com/6/86642819_06d2eb62a4.jpg', Money::of(249.99, 'USD')),
			8 => new Product(8, new Category('trickery', 'Trickery'), 'Bat-Man\'s Outfit', 'Regular size', 'https://66.media.tumblr.com/bd4e393871ebff545b18d08db17e1a5f/tumblr_numd8r42ov1skqw0co7_500.jpg', Money::of(89.99, 'USD')),
			9 => new Product(9, new Category('trickery', 'Trickery'), 'Trick Bone', '', 'http://otsukadev.com/content/wp-content/uploads/2012/01/acme1.png', Money::of(8.99, 'USD')),
		];
	}

	/**
	 * @return Product[]
	 */
	public function findAll(): array
	{
		return array_values($this->products);
	}

	/**
	 * @return Product[]
	 */
	public function findByCategory(Category $category): array
	{
		return array_filter(
			array_values($this->products),
			static fn(Product $product) => $product->getCategory()->getSlug() === $category->getSlug(),
		);
	}

	public function getById(int $id): Product
	{
		return $this->products[$id] ?? throw new \Exception('Product not found.');
	}
}
