<div class="grid grid-rows gap-4">
    <!-- Cart table header -->
    <div class="grid grid-cols-{{$colNum}} gap-4 mx-4 my-4 ">
        <div class="col-span-1 flex justify-center">
            <p class="text-xl">{{ __('Product image') }}</p>
        </div>
        <div class="col-span-1 flex justify-center">
            <p class="text-xl">{{ __('Product name') }}</p>
        </div>
        <div class="col-span-1 flex justify-center">
            <p class="text-xl">{{ __('Price') }}</p>
        </div>
        <div class="col-span-1 flex justify-center">
            <p class="text-xl">{{ __('Quantity') }}</p>
        </div>
        <div class="col-span-1 flex justify-center">
            <p class="text-xl">{{ __('Subtotal') }}</p>
        </div>
    </div>
    <hr class="border-gray-100"/>
    <!-- Products -->
    @foreach($items as $item)
        <div class="grid grid-cols-{{$colNum}} gap-4 mx-6 max-h-50">
            <div class="col-span-1 flex justify-center ">
                <a href="/product/{{ $item->product->id }}">
                    <img class="max-h-40" src="/storage/{{ $item->product->image }}"
                         alt="{{ $item->product->name }}">
                </a>
            </div>
            <div class="col-span-1 flex justify-center">
                <a href="/product/{{ $item->product->id }}">
                    <p class="">{{ $item->product->name }}</p>
                </a>
            </div>
            <div class="col-span-1 flex justify-center">
                <a href="/product/{{ $item->product->id }}">
                    {{ number_format($item->product->price, 2) }}
                </a>
            </div>
            <div class="col-span-1 flex justify-center">
                {{ $item->qty }}
            </div>
            <div class="col-span-1 flex justify-center">
                {{ number_format($item->qty * $item->product->price, 2)}}
            </div>
            @if($type == 'cart')
                <div class="col-span-1 flex justify-center">
                    <x-checkout.remove-from-cart>
                        <x-slot name="cartItemId">{{ $item->id }}</x-slot>
                    </x-checkout.remove-from-cart>
                </div>
            @endif
        </div>
        <hr class="border-gray-100"/>
    @endforeach
</div>
