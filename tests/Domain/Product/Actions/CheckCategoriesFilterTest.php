<?php

namespace Tests\Domain\Product\Actions;

use Spatie\QueryBuilder\QueryBuilder;
use Tests\Domain\Factories\CategoryFactory;
use Tests\Domain\Factories\CityFactory;
use Tests\Domain\Factories\ProductFactory;
use Tests\TestCase;

class CheckCategoriesFilterTest extends TestCase
{
    public function test_categories_filter_should_work_correctly()
    {
        $product = ProductFactory::new()->create();
        $product2 = ProductFactory::new()->create();
        $product3 = ProductFactory::new()->create();

        $relatedThroughPivotModel = CategoryFactory::new()->create();

        $product->categories()->attach($relatedThroughPivotModel->id);

        $queryBuilderResult = QueryBuilder::for($relatedThroughPivotModel->products())->get();

        $this->assertEquals(count($queryBuilderResult), 1);
    }
}
