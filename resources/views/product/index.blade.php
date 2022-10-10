<x-header title="{{ $product->name }}"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-4 col-start-3">
        <img src="/storage/{{$product->image }}" alt="{{ $product->name }}">
        @admin
        <div class="mt-4">
            <a href="/product/edit/{{ $product->id }}">{{ __('Edit product') }}</a>
        </div>
        @endadmin
    </div>
    <div class="col-span-4">
        <div>
            {{ $product->description }}
        </div>
        <div>
            {{$product->price}}
        </div>
        <div>
            @auth()
                <x-cart.add-to-cart-button>
                    <x-slot name="productId">
                        {{ $product->id }}
                    </x-slot>
                </x-cart.add-to-cart-button>
            @endauth
        </div>
    </div>
    <div class="col-span-2"></div>
</div>

