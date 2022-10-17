<!-- Small product grid. Used to display products in cart/order details/wishlist page-->
<div class="grid grid-rows gap-4">
    <!-- Grid header -->
    <div class="grid grid-cols-{{$colNum}} gap-4 mx-4 my-4 ">
        <div class="col-span-2 flex justify-center">
            <p class="text-xl">{{ __('Product image') }}</p>
        </div>
        <div class="col-span-2 flex justify-center">
            <p class="text-xl">{{ __('Product name') }}</p>
        </div>
        <div class="col-span-2 flex justify-center">
            <p class="text-xl">{{ __('Price') }}</p>
        </div>
        @if($type != 'wishlist')
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Quantity') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Subtotal') }}</p>
            </div>
        @endif
    </div>
    <hr class="border-gray-100"/>
    <!-- Products -->
    @php /** @var \App\Models\ProductRelatedItem $item */@endphp
    @foreach($container->items as $item)
        <div class="grid grid-cols-{{$colNum}} gap-4 mx-6 max-h-50">
            <div class="col-span-2 flex justify-center ">
                <a href="/product/{{ $item->product->id }}">
                    <img class="max-h-40" src="/storage/{{ $item->product->image }}"
                         alt="{{ $item->product->name }}">
                </a>
            </div>
            <div class="col-span-2 flex justify-center">
                <a href="/product/{{ $item->product->id }}">
                    <p class="">{{ $item->product->name }}</p>
                </a>
            </div>
            <div class="col-span-2 flex justify-center">
                <p>
                    {{ number_format($item->product->price, 2) }}
                </p>
            </div>
            @if($type != 'wishlist')
                <div class="col-span-2 flex justify-center">
                    {{ $item->qty }}
                </div>
                <div class="col-span-2 flex justify-center">
                    {{ number_format($item->qty * $item->product->price, 2)}}
                </div>
            @endif
            @if($type == 'cart')
                <div class="col-span-2 flex justify-center">
                    <div>
                        <x-buttons.remove-from-cart-button item-id="{{$item->id}}"/>
                    </div>
                </div>
            @elseif($type == 'wishlist')
                <div class="col-span-2 flex justify-center">
                    <div>
                        <x-buttons.remove-from-wishlist-button item-id="{{$item->id}}"/>
                    </div>
                </div>
            @endif
        </div>
        <hr class="border-gray-100"/>
    @endforeach
</div>
