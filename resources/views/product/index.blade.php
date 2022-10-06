<x-header/>
<hr class="mt-4 mb-4"/>

<div class="flex justify-center mb-4">
    <h1 class="text-5xl">{{ $product->name }}</h1>
</div>
<hr class="mt-4 mb-4"/>

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2"></div> <!-- TODO remove this ridiculous stuff -->
    <div class="col-span-4">
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
            <x-cart.add-to-cart-button>
                <x-slot name="productId">
                    {{ $product->id }}
                </x-slot>
            </x-cart.add-to-cart-button>
        </div>
    </div>
    <div class="col-span-2"></div>
</div>

