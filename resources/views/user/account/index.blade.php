<x-header title="{{ __('Account') }}"/>
<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="account"/>
    <div class="col-span-8 bg-blue-200 sm:rounded-lg">
        <div class="grid grid-cols-12 gap-4">
            <!-- Account Information-->
            <div class="col-span-6 my-6 ml-6">
                <x-main-form>
                    <p class="text-center">{{ __('Account Information') }}</p>
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="m-1">
                            <x-input-label for="username" :value="__('Username')"/>

                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                          value="{{ $user->username }}" required autofocus/>

                            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
                        </div>

                        <div class="m-1">
                            <x-input-label for="email" :value="__('Email')"/>

                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                                          value="{{ $user->email }}" required autofocus/>

                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <div class="m-1">
                            <x-input-label for="first_name" :value="__('First Name')"/>

                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                          value="{{ $user->first_name }}" autofocus/>

                            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                        </div>

                        <div class="m-1">
                            <x-input-label for="last_name" :value="__('Last Name')"/>

                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                          value="{{ $user->last_name }}" autofocus/>

                            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                        </div>

                        <div class="mx-1 mb-1 mt-10">
                            <x-input-label for="current_password" :value="__('Current Password')"/>

                            <x-text-input id="current_password" class="block mt-1 w-full"
                                          type="password"
                                          name="current_password"
                            />

                            <x-input-error :messages="$errors->get('current_password')" class="mt-2"/>
                        </div>

                        <div class="m-1">
                            <x-input-label for="new_password" :value="__('New Password')"/>

                            <x-text-input id="new_password" class="block mt-1 w-full"
                                          type="password"
                                          name="new_password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <div class="m-1">
                            <x-input-label for="new_password_confirmation" :value="__('Confirm New Password')"/>

                            <x-text-input id="new_password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="new_password_confirmation"/>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Edit Account Information') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-main-form>
            </div>
            <!-- Default Address -->
            <div class="col-span-6 my-6 mr-6">
                @if($user->getDefaultAddress())
                    <x-user.address-form
                            action="{{ route('address.update', $user->getDefaultAddress()->id) }}"
                            addressId="{{ $user->getDefaultAddress()->id }}"
                            form-title="{{ __('Default address') }}"
                            title="{{$user->getDefaultAddress()->title}}"
                            country="{{$user->getDefaultAddress()->country}}"
                            city="{{$user->getDefaultAddress()->city}}"
                            street="{{$user->getDefaultAddress()->street}}"
                            zip="{{$user->getDefaultAddress()->zip}}"
                            phone="{{$user->getDefaultAddress()->phone}}"
                            isDefault="{{ true }}"/>
                @else
                    <p class="text-xl text-center">{{ __('You don\'t have default address yet') }}</p>
                    <a href="{{ route('user.address.index') }}"><p class="text-center text-xl">
                            {{ __('Visit addresses tab to add it or make existent address default') }}
                        </p></a>
                @endif

            </div>
        </div>
    </div>
</div>