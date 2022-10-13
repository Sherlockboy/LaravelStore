<x-header title="{{ 'Order # ' . $order->id }}"/>
<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    {{ 'Status: ' . $order->status}}
</div>
@admin
<x-admin.order-status-update-tab :order="$order"/>
@endadmin
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="orders"/>
    <x-order.order-details :order="$order"/>
</div>