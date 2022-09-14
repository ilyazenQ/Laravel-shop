<?php

namespace App\Http\Controllers\Products;

use App\Domain\Category\Category;
use App\Domain\City\City;
use App\Domain\Product\Actions\SaveFiltersInSessionAction;
use App\Domain\Product\Product;
use App\Domain\Product\ProductQuery;
use Illuminate\Http\Request;


class ProductIndexController
{
    public function __invoke(Request $request)
    {
        $products = (new ProductQuery())->paginate()->appends($request->query());
        $categories = Category::all();
        $cities = City::all();

        SaveFiltersInSessionAction::execute($request);

        $session = $request->session()->all();

        return view('products.index', [
            'products' => $products,
            'cities' => $cities,
            'categories' => $categories,
            'session' => $session
        ]);
    }
}
