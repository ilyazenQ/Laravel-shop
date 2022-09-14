<?php

namespace Tests\Domain\Product\Actions;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Tests\Domain\Factories\CategoryFactory;
use Tests\Domain\Factories\CityFactory;
use Tests\Domain\Factories\ProductFactory;
use Tests\TestCase;

class CheckCategoriesAndCitiesFilterTogetherTest extends TestCase
{
    public function test_categories_and_cities_filter_together_should_work_correctly()
    {
        $product = ProductFactory::new()->create();
        $product2 = ProductFactory::new()->create();
        $product3 = ProductFactory::new()->create();

        $category = CategoryFactory::new()->create();
        $city = CityFactory::new()->create();

        $product->categories()->attach($category->id);
        $product->cities()->attach($city->id);

        $product2->cities()->attach($city->id);

        $req = new Request([
            'filter' => [
                'cities.id' => [
                     $city->id
                ],
                'categories.id' => $category->id
            ],
        ]);

        $queryBuilderResult = QueryBuilder::for($product,$req)
            ->allowedFilters(['categories.id', 'cities.id'])
            ->get();

        $this->assertEquals(count($queryBuilderResult), 1);
        $this->assertEquals($queryBuilderResult[0]->id, $product->id);
    }
}
