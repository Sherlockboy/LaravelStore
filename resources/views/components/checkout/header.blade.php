<div class="grid grid-cols-4 gap-4 my-6">
    <div class=" col-span-1 col-start-2 text-center text-3xl">
        <a href="{{ route('checkout.shipping') }}">
            <div class="{{ $active == 'shipping' ? ' bg-blue-200' : ' bg-white'}} sm:rounded-lg">
            {{ __('Shipping') }}
            </div>
        </a>
    </div>

    <div class="col-span-1 col-end-4 text-center text-3xl">
        <a href="{{ route('checkout.billing') }}">
            <div class="{{ $active == 'billing' ? ' bg-blue-200' : ' bg-white'}} sm:rounded-lg">
                {{ __('Billing') }}
            </div>
        </a>
    </div>
</div>