<x-header title="{{ $product->name }}"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-4 col-start-3">
        <img src="/storage/{{$product->image }}" alt="{{ $product->name }}">
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
                <x-checkout.add-to-cart-button product-id="{{$product->id}}"/>
            @endauth
        </div>
    </div>
    <div class="col-span-2"></div>
</div>

