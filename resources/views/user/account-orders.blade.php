<x-header title="Orders"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-user.account-nav current="orders"/>
    </div>
    <div class="col-span-8 bg-blue-200 sm:rounded-lg">
        <div class="grid grid-rows">
            <div class="grid grid-cols-8 border border-gray-100">
                <div class="m-1 text-center text-xl">{{ __('Order Id') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Status') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Price') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Country') }}</div>
                <div class="m-1 text-center text-xl">{{ __('City') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Street') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Zip') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Phone') }}</div>
            </div>
            @foreach($user->orders as $order)
                <a href="{{ route('order.show', $order->id) }}">
                    <div class="grid grid-cols-8 border border-gray-100">
                        <div class="m-1 text-center">{{ $order->id }}</div>
                        <div class="m-1 text-center">{{ $order->status }}</div>
                        <div class="m-1 text-center">{{ $order->final_price }}</div>
                        <div class="m-1 text-center">{{ $order->country }}</div>
                        <div class="m-1 text-center">{{ $order->city }}</div>
                        <div class="m-1 text-center">{{ $order->street }}</div>
                        <div class="m-1 text-center">{{ $order->zip }}</div>
                        <div class="m-1 text-center">{{ $order->phone }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>