<x-header title="{{ 'Order # ' . $order->id }}"/>
<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    {{ 'Status: ' . $order->status}}
</div>
@admin
<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    <form method="POST" action="{{ route('admin.order.edit', $order->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="m-4">
            <label for="order-status">{{ __('Order status') }}</label>
            <select id="order-status" name="order-status"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="{{ \App\Models\Order::STATUS_PENDING }}">{{ \App\Models\Order::STATUS_PENDING }}</option>
                <option value="{{ \App\Models\Order::STATUS_PROCESSING }}">{{ \App\Models\Order::STATUS_PROCESSING }}</option>
                <option value="{{ \App\Models\Order::STATUS_COMPLETED }}">{{ \App\Models\Order::STATUS_COMPLETED }}</option>
                <option value="{{ \App\Models\Order::STATUS_CANCELED }}">{{ \App\Models\Order::STATUS_CANCELED }}</option>
            </select>
        </div>
        <div class="m-4">
            <x-primary-button>
                {{ __('Update order status') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endadmin
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-user.account-nav current=""/>
    </div>
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
</div>