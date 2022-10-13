<div class="col-span-8 bg-blue-200 sm:rounded-lg">
    <div class="grid grid-rows">
        <div class="grid grid-cols-{{$colNum}} border border-gray-100">
            @if($type == 'admin')
                <div class="m-1 text-center text-xl">{{ __('Order Id') }}</div>
                <div class="m-1 text-center text-xl">{{ __('User Id') }}</div>
            @endif
            <div class="m-1 text-center text-xl">{{ __('Order Id') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Status') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Price') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Country') }}</div>
            <div class="m-1 text-center text-xl">{{ __('City') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Street') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Zip') }}</div>
            <div class="m-1 text-center text-xl">{{ __('Phone') }}</div>
        </div>
        @foreach($orders as $order)
            <a href="{{ route('order.show', $order->id) }}">
                <div class="grid grid-cols-{{$colNum}} border border-gray-100
                       {{ $loop->odd ? 'bg-gray-200' : 'bg-gray-300'}}">
                    @if($type == 'admin')
                        <div class="m-1 text-center">{{ $order->id }}</div>
                        <div class="m-1 text-center">{{ $order->user->id }}</div>
                    @endif
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
