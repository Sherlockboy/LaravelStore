<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    <form method="POST" action="{{ route('admin.order.update', $order->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="m-4">
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
        <div class="m-4">
            <x-primary-button>
                {{ __('Update order status') }}
            </x-primary-button>
        </div>
    </form>
</div>
