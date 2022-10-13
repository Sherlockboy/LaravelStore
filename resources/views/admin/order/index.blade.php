<x-header title="{{__('Admin Panel: Orders')}}"/>
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="orders"/>
    <x-grid.order-grid :orders="$orders" type="admin"/>
</div>
<div class="flex justify-center m-4">
    {{ $orders->links()}}
</div>