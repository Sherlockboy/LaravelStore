<x-header title="{{ __('Shopping Cart') }}"/>
@if($cart->items->count())
    <div class="grid grid-cols-12">
        <div class="col-span-8 col-start-2 bg-blue-200 sm:rounded-lg">
            <x-grid.small-product-grid :items="$cart->items" type="cart"/>
            <div class="grid grid-cols-12 gap-4  mx-6 mb-6 max-h-50">
                <div class="col-span-2 flex justify-center col-start-11">
                    <x-checkout.clear-cart/>
                </div>
            </div>
        </div>
        <!-- Summary -->
        <div class="col-span-2">
            <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6 bg-blue-200 sm:rounded-lg">
                <div class="flex justify-center mt-10">
                    <p class="text-xl text-gray-500">{{ __('Summary') }}</p>
                </div>
                <div class="flex justify-center">
                    <p class="text-xl">{{ __('Final price: ') .  number_format($finalPrice, 2) }}</p>
                </div>
                <div class="flex justify-center mb-10">
                    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2">
                        <a href="{{ route('checkout.shipping') }}">{{ __('Proceed to checkout') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Empty cart -->
    <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6 ms-6 bg-blue-100">
        <div class="grid gap-4 ml-6 mr-6 ">
            <p class="text-gray-700 text-xl text-center">{{ __('Your shopping cart is empty') }}</p>
        </div>
    </div>
@endif
