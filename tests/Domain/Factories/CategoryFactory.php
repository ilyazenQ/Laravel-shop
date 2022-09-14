<?php

namespace Tests\Domain\Factories;

use App\Domain\Category\Category;
use App\Domain\City\City;

class CategoryFactory
{
    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): Category
    {
        $city = Category::create(
            [
                'label'=>'labelForTest'
            ] + $extra
        );

        return $city->refresh();
    }
}
