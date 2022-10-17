<div class="col-span-7 bg-blue-200 sm:rounded-lg mb-4">
    <div class="text-xl text-center">{{ __('Ordered items') }}</div>
    <x-grid.small-product-grid :container="$order" type="order"/>
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
