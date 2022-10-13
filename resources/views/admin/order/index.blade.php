<x-header title="{{__('Admin Panel: Orders')}}"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-admin.admin-nav current="orders"/>
    </div>
    <x-order-grid type="admin"/>
</div>
<div class="flex justify-center m-4">
    {{ $orders->links()}}
</div>