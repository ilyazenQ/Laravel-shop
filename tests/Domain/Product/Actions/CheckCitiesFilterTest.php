<?php

namespace Tests\Domain\Product\Actions;

use Spatie\QueryBuilder\QueryBuilder;
use Tests\Domain\Factories\CityFactory;
use Tests\Domain\Factories\ProductFactory;
use Tests\TestCase;

class CheckCitiesFilterTest extends TestCase
{
    public function test_cities_filter_should_work_correctly()
    {
        $product = ProductFactory::new()->create();
        $product2 = ProductFactory::new()->create();
        $product3 = ProductFactory::new()->create();

        $relatedThroughPivotModel = CityFactory::new()->create();

        $product->cities()->attach($relatedThroughPivotModel->id);
        $product2->cities()->attach($relatedThroughPivotModel->id);

        $queryBuilderResult = QueryBuilder::for($relatedThroughPivotModel->products())->get();

       $this->assertEquals(count($queryBuilderResult), 2);
    }
}
