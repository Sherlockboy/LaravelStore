<x-header title="{{ __('Checkout') }}"/>
<x-checkout.header active="shipping"/>
@if($user->cart->cartItems->count())
    <div class="grid grid-cols-12">
        <div class="col-span-8 col-start-2 mx-6 mb-6 bg-blue-200 sm:rounded-lg">
            <p class="text-xl text-center text-gray-500 mt-2">{{ __('Shipping address') }}</p>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    1
                </div>
                <div class="col-span-1">
                    <div class="col-span-6 my-6 mr-6">
                        <x-main-form>
                            <p class="text-center">{{ __('Default address') }}</p>
                            <form method="POST" action="{{ route('address.update', ) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="m-1">
                                    <x-input-label for="country" :value="__('Country')" />

                                    <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                                                  value="{{ $user->address ? $user->address->first()->country : ''}}" required autofocus />

                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>

                                <div class="m-1">
                                    <x-input-label for="city" :value="__('City')" />

                                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                                  value="{{ $user->address ? $user->address->first()->city : ''}}" required autofocus />

                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div class="m-1">
                                    <x-input-label for="street" :value="__('Street')" />

                                    <x-text-input id="street" class="block mt-1 w-full" type="text" name="street"
                                                  value="{{ $user->address ? $user->address->first()->street : ''}}" required autofocus />

                                    <x-input-error :messages="$errors->get('street')" class="mt-2" />
                                </div>
                                <div class="m-1">
                                    <x-input-label for="zip" :value="__('Zip/Postal Code')" />

                                    <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip"
                                                  value="{{ $user->address ? $user->address->first()->zip : ''}}" required autofocus />

                                    <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                                </div>
                                <div class="m-1">
                                    <x-input-label for="phone" :value="__('Phone')" />

                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                                  value="{{ $user->address ? $user->address->first()->phone : ''}}" required autofocus />

                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-center mt-4">
                                    <x-primary-button class="ml-4">
                                        {{ __('Save Default Address') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-main-form>
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
                    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2">
                        <a href="{{ route('checkout.billing') }}">{{ __('Next') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif