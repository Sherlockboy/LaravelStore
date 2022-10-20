@php /** @var \App\Models\Order $order */ @endphp
<x-header title="{{ 'Order # ' . $order->id }}"/>
<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    <div class="text-center">
        {{ 'Status: ' . $order->status}}
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="orders"/>
    <x-order.order-details :order="$order" type="user"/>
</div>