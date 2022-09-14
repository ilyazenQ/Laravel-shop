<?php

namespace App\Domain\Product;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductQuery extends QueryBuilder
{
    public function __construct()
    {

        $query = Product::query();

        parent::__construct($query);

        $this->allowedIncludes([
            'cities','categories',
        ]);

        $this->allowedFilters([

            AllowedFilter::scope('place_in_month'),
            AllowedFilter::exact('id'),
            AllowedFilter::exact('cities.id'),
            AllowedFilter::exact('categories.id'),

        ]);

        $this->defaultSort('created_at');

    }
}
