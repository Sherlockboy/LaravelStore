@php /** @var \App\Models\Product $product */ @endphp
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
                @if($product->getRelatedWishlistItem($user))
                    <x-grid.remove-product-action-button item-id="{{$product->getRelatedWishlistItem($user)->id}}"
                                                         entity-type="wishlist"/>
                @else
                    <x-grid.add-product-action-button product-id="{{$product->id}}" entity-type="wishlist"/>
                @endif
            @endauth

        </div>
        <div>
            <x-grid.add-product-action-button product-id="{{$product->id}}" entity-type="cart"/>
        </div>
    </div>
    <div class="col-span-2"></div>
</div>

