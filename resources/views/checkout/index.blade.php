<x-header title="{{ __('Checkout') }}"/>
@if($user->cart->cartItems->count())
    <div class="grid grid-cols-12">
        <div class="col-span-8 col-start-2 mx-6 mb-6 bg-blue-200 sm:rounded-lg">
            <p class="text-3xl text-center text-gray-500 mt-2">{{ __('Delivery address') }}</p>
            <div class="grid grid-cols-11 gap-4">
                <div class="col-span-5">
                    <div class="my-6 ml-6">
                        <x-main-form>
                            <form method="POST" action="#" enctype="multipart/form-data">
                                <label for="delivery-address">{{ __('Select delivery address') }}</label>
                                <select name="delivery-address" id="delivery-address"
                                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($user->addresses as $address)
                                        <option value="{{$address->id}}"
                                                id="address-id" {{ $address->is_default ? 'selected' : '' }}>
                                            {{ __($address->title) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </x-main-form>
                    </div>
                    <div class="grid grid-rows my-6 ml-6">
                        <x-main-form>
                            <form method="POST" action="#" enctype="multipart/form-data">
                                <label for="payment-method">{{ __('Select payment method') }}</label>
                                <select name="payment-method" id="payment-method"
                                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" id="payment-id">
                                    </option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{$method->code}}" id="payment-id">
                                            {{ __($method->title) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </x-main-form>
                    </div>
                    <div class="grid grid-rows my-6 ml-6">
                        <x-main-form>
                            <form method="POST" action="#" enctype="multipart/form-data">
                                <label for="shipment-method">{{ __('Select shipment method') }}</label>
                                <select name="shipment-method" id="shipment-method"
                                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" id="shipment-id">

                                    </option>
                                    @foreach($shipmentMethods as $method)
                                        <option value="{{$method->code}}"
                                                id="shipment-id">
                                            {{ __($method->title) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </x-main-form>
                    </div>
                </div>
                <div class="col-span-1 flex justify-center">
                    <span class="text-3xl">{{ __('OR') }}</span>
                </div>
                <div class="col-span-5">
                    <div class="col-span-6 my-6 mr-6">
                        <x-user.address-form form-title="{{ __('Add new address') }}"
                                             action="{{ route('address.store') }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="grid grid-rows gap-4 mx-6 mb-6 bg-blue-200 sm:rounded-lg">
                <div class="flex justify-center mt-2">
                    <p class="text-xl text-gray-500">{{ __('Order Summary') }}</p>
                </div>
                @foreach($user->cart->cartItems as $cartItem)
                    <div class="grid grid-cols-8 gap-4 mx-6">
                        <div class="col-span-4 flex justify-center">
                            <a href="/product/{{ $cartItem->product->id }}">
                                <img class="max-h-40" src="/storage/{{ $cartItem->product->image }}"
                                     alt="{{ $cartItem->product->name }}">
                            </a>
                        </div>
                        <div class="col-span-4 flex justify-center">
                            <div class="grid grid-rows">
                                <div>{{ $cartItem->product->name }}</div>
                                <div>{{ 'Qty: ' . $cartItem->qty }}</div>
                                <div>{{ 'Price: ' . $cartItem->product->price * $cartItem->qty }}</div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endforeach
                <div class="flex justify-center">
                    <p class="text-xl">{{ __('Final price: ') .  number_format($finalPrice, 2) }}</p>
                </div>
                <div class="flex justify-center mb-2">
                    <x-checkout.place-order-button/>
                </div>
            </div>
        </div>
    </div>
@endif