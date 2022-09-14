@php
/** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Domain\Product\Product[] $products */
@endphp
<x-app-layout title="Products">

    <div class="mx-auto mt-12">
        <form action="" novalidate="novalidate" method="get">

            <div class="mb-2">
                <h6 class="p-1 border-bottom">Город</h6>

                <select class="form-select"
                        id="location" name='filter[cities.id][]'
                        multiple="multiple"
                >
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}"
                                @if(
                                isset($session['filter']['cities.id'])
                                && in_array($city->id,$session['filter']['cities.id']))
                                    selected @endif
                        >
                            {{ $city->label }}</option>
                    @endforeach

                </select>

            </div>
            <div class="mb-2">
                <h6 class="p-1 border-bottom">Категория</h6>
                <select class="form-select"
                        id="month"
                        name="filter[categories.id]"
                       >
                    <option value="">Любая категория</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                                @if(
                            isset($session['filter']['categories.id'])
                            && $session['filter']['categories.id'] == $cat->id)
                            selected @endif
                        >{{ $cat->label }}</option>
                    @endforeach

                </select>
            </div>


            </div>
            <button type="submit" class="btn btn-primary">Применить</button>
        <button type="submit" class="btn btn-primary"><a href="/">Показать все</a></button>
        </form>
    </div>

    <div class="grid grid-cols-3 gap-12">
        @foreach($products as $product)
            <x-product
                :title="$product->name"
                :price="format_money($product->getItemPrice()->pricePerItemIncludingVat())"
                :actionUrl="action(\App\Http\Controllers\Cart\AddCartItemController::class, [$product])"
          />
        @endforeach
    </div>

    <div class="mx-auto mt-12">
        {{ $products->links() }}
    </div>
</x-app-layout>
