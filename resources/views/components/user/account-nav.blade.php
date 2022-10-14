<div class="col-span-1 col-start-2 bg-blue-200 sm:rounded-lg">
    <div class="grid grid-rows-4 justify-center">
        <div>
            <a href="{{ route('user.account.index') }}"
               class="{{ $current == 'account' ? 'font-bold' : '' }}">{{ __('My Account') }}</a>
        </div>
        <div>
            <a href="{{ route('order.index') }}"
               class="{{ $current == 'orders' ? 'font-bold' : '' }}">{{ __('My Orders') }}</a>
        </div>

        <div>
            <a href="{{ route('user.address.index') }}"
               class="{{ $current == 'addresses' ? 'font-bold' : '' }}">{{ __('My Addresses') }}</a>
        </div>
        <div>
            <a href="{{ route('wishlist.index') }}"
               class="{{ $current == 'wishlist' ? 'font-bold' : '' }}">{{ __('My Wishlist') }}</a>
        </div>
    </div>
</div>
