<x-header title="{{ __('Home') }}"/>
<div class="grid grid-rows">
    <div class="grid grid-cols-12 gap-4">
        @foreach($products as $product)
            <div class="col-span-3 ml-4 mr-4">
                <div class="grid grid-rows-12">
                    <div class="flex justify-center row-span-2">
                        <a href="/product/{{ $product->id }}">
                            <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}">
                        </a>
                    </div>
                    <div class="flex justify-center row-span-2">
                        <div>
                            <a href="/product/{{ $product->id }}"><p class="text-xl">{{ $product->name }}</p></a>
                        </div>
                    </div>
                    <div class="flex justify-center row-span-2">
                        <p>
                            {{ __('Categories: ') }}
                            @foreach($product->categories as $category)
                                <a href="{{ route('category.index', $category->id) }}">
                                    {{$category->name . ($loop->last ? '' : ',')}}
                                </a>
                            @endforeach
                        </p>
                    </div>
                    <div class="flex justify-center row-span-2">
                        <p>
                            {{ __('Price: ') }}
                            {{ $product->price }}
                        </p>
                    </div>
                    <div class="flex justify-center row-span-2">
                        @auth()
                            <x-checkout.add-to-cart-button product-id="{{$product->id}}"/>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-4">
        {{ $products->links() }}
    </div>
</div>
