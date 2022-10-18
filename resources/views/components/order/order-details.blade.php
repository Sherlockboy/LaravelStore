<div class="col-span-7 bg-blue-200 sm:rounded-lg mb-4">
    <div class="text-xl text-center">{{ __('Ordered items') }}</div>
    <div class="grid grid-rows gap-4">
        <!-- Grid header -->
        <div class="grid grid-cols-10 gap-4 mx-4 my-4 ">
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Product image') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Product name') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Price') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Quantity') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Subtotal') }}</p>
            </div>
        </div>
        <hr class="border-gray-100"/>
        <!-- Products -->
        @foreach($order->items as $item)
            <div class="grid grid-cols-10 gap-4 mx-6 max-h-50">
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
                <div class="col-span-2 flex justify-center">
                    {{ $item->qty }}
                </div>
                <div class="col-span-2 flex justify-center">
                    {{ number_format($item->qty * $item->product->price, 2)}}
                </div>
            </div>
            <hr class="border-gray-100"/>
        @endforeach
    </div>
</div>
<div class="col-span-2 bg-gray-200 sm:rounded-lg mb-4">
    <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6">
        <div class="flex justify-center mt-10">
            <p class="text-xl text-gray-500">{{ __('Order Summary') }}</p>
        </div>
        <div class="flex justify-center">
            <p class="text-xl">{{ __('Final price: ') .  number_format($order->final_price, 2) }}</p>
        </div>
        <div class="flex justify-center mb-10">
            <div class="grid grid-rows">
                <div class="text-xl text-center">
                    {{ __('Order details') }}
                </div>
                <div>
                    <div><strong>{{ __('Full Name: ')}}</strong>{{$order->full_name}}</div>
                    <div><strong>{{ __('Email: ')}}</strong>{{$order->email}}</div>
                    <div><strong>{{ __('Country: ')}}</strong>{{$order->country}}</div>
                    <div><strong>{{ __('City: ')}}</strong>{{$order->city}}</div>
                    <div><strong>{{ __('Street: ')}}</strong>{{$order->street}}</div>
                    <div><strong>{{ __('Zip: ')}}</strong>{{$order->zip}}</div>
                    <div><strong>{{ __('Phone: ')}}</strong>{{$order->phone}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
