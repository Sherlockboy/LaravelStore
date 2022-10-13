<div class="col-span-8 bg-blue-200 sm:rounded-lg">
    <div class="text-xl text-center">{{ __('Ordered items') }}</div>
    <x-grid.product-grid :items="$order->orderItems" type="order"/>

</div>