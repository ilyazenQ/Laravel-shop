<?php

namespace Tests\Domain\Factories;

use App\Domain\City\City;

class CityFactory
{
    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): City
    {
        $city = City::create(
            [
                'label'=>'labelForTest'
            ] + $extra
        );

        return $city->refresh();
    }
}
