<x-header title="{{ __('Shopping Cart') }}" />
@if($user->cart->cartItems->count())
    <div class="grid grid-cols-12">
        <div class="col-span-8 col-start-2">
            <div class="grid grid-rows gap-4 bg-blue-200">
                <!-- Cart table header -->
                <div class="grid grid-cols-12 gap-4 mx-4 my-4 ">
                    <div class="col-span-2 flex justify-center">
                        <p class="text-xl">{{ __('Product image') }}</p>
                    </div>
                    <div class="col-span-2 flex justify-center">
                        <p class="text-xl">{{ __('Product name') }}</p>
                    </div>
                    <div class="col-span-2 flex justify-center">
                        <p class="text-xl">{{ __('Price') }}</p>
                    </div>
                    <div class="col-span-2 flex justify-center">
                        <p class="text-xl">{{ __('Quantity') }}</p>
                    </div>
                    <div class="col-span-2 flex justify-center">
                        <p class="text-xl">{{ __('Subtotal') }}</p>
                    </div>
                </div>
                <!-- Products -->
                @foreach($user->cart->cartItems as $cartItem)
                    <div class="grid grid-cols-12 gap-4 ml-6 mr-6 max-h-50">
                        <div class="col-span-2 flex justify-center ">
                            <a href="/product/{{ $cartItem->product->id }}">
                                <img class="max-h-40" src="/storage/{{ $cartItem->product->image }}"
                                     alt="{{ $cartItem->product->name }}">
                            </a>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <a href="/product/{{ $cartItem->product->id }}">
                                <p class="">{{ $cartItem->product->name }}</p>
                            </a>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <a href="/product/{{ $cartItem->product->id }}">
                                {{ number_format($cartItem->product->price, 2) }}
                            </a>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            {{ $cartItem->qty }}
                        </div>
                        <div class="col-span-2 flex justify-center">
                            {{ number_format($cartItem->qty * $cartItem->product->price, 2)}}
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <x-cart.remove-from-cart>
                                <x-slot name="cartItemId">{{ $cartItem->id }}</x-slot>
                            </x-cart.remove-from-cart>
                        </div>
                    </div>
                    <hr class="border-gray-100"/>
                @endforeach
                <div class="grid grid-cols-12 gap-4  mx-6 mb-6 max-h-50">
                    <div class="col-span-2 flex justify-center col-start-11">
                        <x-cart.clear-cart/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Summary -->
        <div class="col-span-2">
            <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6 bg-blue-200">
                <div class="flex justify-center mt-10">
                    <p class="text-xl text-gray-500">{{ __('Summary') }}</p>
                </div>
                <div class="flex justify-center">
                    <p class="text-xl">{{ __('Final price: ') .  number_format($finalPrice, 2) }}</p>
                </div>
                <div class="flex justify-center mb-10">
                    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2">
                        <a href="{{ route('checkout.index') }}">{{ __('Proceed to checkout') }}</a>
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
