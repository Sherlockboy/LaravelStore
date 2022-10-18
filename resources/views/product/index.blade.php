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
                @if($user->wishlist->getItemByRelatedId($product->id))
                    <x-buttons.remove-from-wishlist-button
                            item-id="{{$user->wishlist->getItemByRelatedId($product->id)->id}}"/>
                @else
                    <x-buttons.add-to-wishlist-button product-id="{{number_format($product->id, 2)}}"/>
                @endif
            @endauth

        </div>
        <div>
            <x-buttons.add-to-cart-button product-id="{{$product->id}}"/>
        </div>
    </div>
    <div class="col-span-2"></div>
</div>

