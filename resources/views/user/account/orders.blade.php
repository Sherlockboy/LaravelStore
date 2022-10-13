<x-header title="Orders"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-user.account-nav current="orders"/>
    </div>
    <x-order-grid type="user"/>
</div>