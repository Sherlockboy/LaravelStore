<x-main-form>
    <p class="text-center">{{ __($title ?? '') }}</p>
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        <div class="m-1">
            <x-input-label for="title" :value="__('Address Title')"/>
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                          value="{{ $title ?? ''}}" required autofocus/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <div class="m-1">
            <x-input-label for="country" :value="__('Country')"/>
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                          value="{{ $country ?? ''}}" required autofocus/>
            <x-input-error :messages="$errors->get('country')" class="mt-2"/>
        </div>

        <div class="m-1">
            <x-input-label for="city" :value="__('City')"/>
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                          value="{{ $city ?? ''  }}" required autofocus/>
            <x-input-error :messages="$errors->get('city')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="street" :value="__('Street')"/>
            <x-text-input id="street" class="block mt-1 w-full" type="text" name="street"
                          value="{{ $street ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('street')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="zip" :value="__('Zip/Postal Code')"/>
            <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip"
                          value="{{ $zip ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('zip')" class="mt-2"/>
        </div>
        <div class="m-1">
            <x-input-label for="phone" :value="__('Phone')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                          value="{{  $phone ?? '' }}" required autofocus/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <div class="m-1">
            <label class="block font-medium text-sm text-gray-700"
                   for="is_default"> {{ __('Is Default')}}</label>
            <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                   id="is_default" type="checkbox" name="is_default"
                    {{ isset($isDefault) && $isDefault ? 'checked' : ''}}/>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-4">
                {{ __('Save Address') }}
            </x-primary-button>
        </div>
    </form>
    @if(isset($addressId))
        <button class="mt-2" onclick="deleteAddress({{ $addressId }}, '{{ url()->current() }}')">
            {{ __('Delete address') }}
        </button>
        <script>
            function deleteAddress(addressId, redirectUrl) {
                if (confirm('Are you sure you want to delete address?')) {
                    axios.delete('{{ route('address.delete', $addressId) }}')
                        .then(response => {
                            alert('Address ' + response.data.title + ' was deleted');
                            window.location.href = redirectUrl;
                        })
                }
            }
        </script>
    @endif
</x-main-form>
