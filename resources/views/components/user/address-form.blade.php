<x-main-form>
    <p class="text-center">{{ __($address->title ?? 'Add new address') }}</p>
    <form method="POST" action="{{ $action ?? route('address.store')}}" enctype="multipart/form-data">
        @csrf
            @method($action ? 'PATCH' : 'POST')
        @auth()
            <div class="m-1">
                <x-input-label for="title" :value="__('Address Title')"/>
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                              value="{{ $address->title ?? ''}}" required autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>
        @endauth
        <div class="m-1">
            <x-input-label for="full_name" :value="__('Full name')"/>
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                          value="{{ $address->full_name ?? (auth()->user()->full_name ?? '')}}" required autofocus/>
            <x-input-error :messages="$errors->get('full_name')" class="mt-2"/>
        </div>

        @guest()
            <div class="m-1">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              required autofocus/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>
        @endguest

        <div class="m-1">
            <x-input-label for="country" :value="__('Country')"/>
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                          value="{{ $address->country ?? ''}}" required autofocus/>
            <x-input-error :messages="$errors->get('country')" class="mt-2"/>
        </div>

        <div class="m-1">
            <x-input-label for="city" :value="__('City')"/>
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                          value="{{ $address->city ?? ''  }}" required autofocus/>
            <x-input-error :messages="$errors->get('city')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="street" :value="__('Street')"/>
            <x-text-input id="street" class="block mt-1 w-full" type="text" name="street"
                          value="{{ $address->street ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('street')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="zip" :value="__('Zip/Postal Code')"/>
            <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip"
                          value="{{ $address->zip ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('zip')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="phone" :value="__('Phone')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                          value="{{  $address->phone ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>
        @auth()
            <div class="m-1">
                <label class="block font-medium text-sm text-gray-700"
                       for="is_default"> {{ __('Is Default')}}</label>
                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                       id="is_default" type="checkbox" name="is_default"
                        {{ $address->id && $address->is_default ? 'checked' : ''}}/>
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Save Address') }}
                </x-primary-button>
            </div>
        @endauth
    </form>
    @if($address->id)
        <button class="mt-2" onclick="deleteAddress()">
            {{ __('Delete address') }}
        </button>
        <script>
            function deleteAddress() {
                if (confirm('Are you sure you want to delete address?')) {
                    axios.delete('{{ route('address.delete', $address->id) }}')
                        .then(response => {
                            alert('Address ' + response.data.title + ' was deleted');
                            window.location.href = '{{url()->current()}}';
                        })
                }
            }
        </script>
    @endif
</x-main-form>
