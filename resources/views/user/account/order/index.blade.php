<x-header title="Orders"/>
<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="orders"/>
    <x-grid.order-grid :orders="$orders" type="user"/>
</div>