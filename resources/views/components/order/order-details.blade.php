<div class="col-span-8 bg-blue-200 sm:rounded-lg">
    <div class="text-xl text-center">{{ __('Ordered items') }}</div>
    <div class="grid grid-rows">
        <div class="grid grid-cols-4 border border-gray-100">
            <div class="m-1 text-center text-xl">{{ __('Product') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Price') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Qty') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Subtotal') }}</div>
        </div>

        @foreach($order->orderItems as $item)
            <div class="grid grid-cols-4 border border-gray-100">
                <div class="m-1 text-center">
                    <a href="{{ route('product.index', $item->product->id) }}">
                        <img src="/storage/{{$item->product->image}}">
                    </a>
                    <a href="{{ route('product.index', $item->product->id) }}">
                        {{$item->product->name}}
                    </a>
                </div>
                <div class="m-1 text-center">{{$item->product->price}}</div>
                <div class="m-1 text-center">{{$item->qty}}</div>
                <div class="m-1 text-center">{{$item->qty * $item->product->price}}</div>
            </div>
        @endforeach
    </div>
</div>