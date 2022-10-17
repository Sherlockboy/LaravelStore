<x-header title="Wishlist"/>
<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="wishlist"/>
    <div class="col-span-9 bg-blue-200 sm:rounded-lg">
        <div class="grid grid-rows">
            <x-grid.small-product-grid type="wishlist" :container="$wishlist"/>
        </div>
    </div>
</div>