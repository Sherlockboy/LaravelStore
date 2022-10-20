@php /** @var \App\Models\Order $order */ @endphp
<x-header title="{{ 'Order # ' . $order->id }}"/>
<div class="grid grid-rows justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    <div class="text-center">
        {{ 'Status: ' . $order->status}}
    </div>
    <div class="text-center">
        <form method="POST" action="{{ route('admin.order.update', $order->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="my-4">
                <label for="order-status">{{ __('Order status') }}</label>
                <select id="order-status" name="order-status"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="{{ \App\Models\Order::STATUS_PENDING }}
                 {{ $order->status == \App\Models\Order::STATUS_PENDING ? 'selected' : '' }}">
                        {{ \App\Models\Order::STATUS_PENDING }}
                    </option>
                    <option value="{{ \App\Models\Order::STATUS_PROCESSING }}"
                            {{ $order->status == \App\Models\Order::STATUS_PROCESSING ? 'selected' : '' }}>
                        {{ \App\Models\Order::STATUS_PROCESSING }}
                    </option>
                    <option value="{{ \App\Models\Order::STATUS_COMPLETED }}"
                            {{ $order->status == \App\Models\Order::STATUS_COMPLETED ? 'selected' : '' }}>
                        {{ \App\Models\Order::STATUS_COMPLETED }}
                    </option>
                    <option value="{{ \App\Models\Order::STATUS_CANCELED }}"
                            {{ $order->status == \App\Models\Order::STATUS_CANCELED ? 'selected' : '' }}>
                        {{ \App\Models\Order::STATUS_CANCELED }}
                    </option>
                </select>
            </div>
            <div class="my-4">
                <x-primary-button>
                    {{ __('Update order status') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="orders"/>
    <x-order.order-details :order="$order" type="admin"/>
</div>