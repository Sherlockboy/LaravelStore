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
            <p>
                <strong>{{ __('Categories: ') }}</strong>
                @php /** @var \App\Models\Category $category */ @endphp
                @foreach($product->categories as $category)
                    <a href="{{ route('category.index', $category->id) }}">
                        {{$category->name . ($loop->last ? '' : ',')}}
                    </a>
                @endforeach
            </p>
        </div>
        <div>
            <strong>{{ __('Price: ') }}</strong> {{number_format($product->price, 2)}}
        </div>
        <div>
            @auth()
                @if($user->wishlist->getItemByProductId($product->id))
                    <x-wishlist.remove-from-wishlist-button
                            item-id="{{$user->wishlist->getItemByProductId($product->id)->id}}"/>
                @else
                    <x-wishlist.add-to-wishlist-button product-id="{{number_format($product->id, 2)}}"/>
                @endif
            @endauth

        </div>
        <div>
            <x-checkout.cart.add-to-cart-button product-id="{{$product->id}}"/>
        </div>
    </div>
</div>

