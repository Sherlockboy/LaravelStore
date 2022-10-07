<x-header title="{{ __('Account') }}"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-red-500">
        <x-customer.account-nav/>
    </div>
    <div class="col-span-8 bg-blue-500">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 m-6">
                <x-main-form>
                    <p class="text-center">{{ __('Account Information') }}</p>
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Edit Account Information') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-main-form>
            </div>
            <div class="col-span-6m-6">
                2
            </div>
        </div>
    </div>
</div>