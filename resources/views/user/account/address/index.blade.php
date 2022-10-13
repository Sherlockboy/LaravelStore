<x-header title="{{ __('Addresses') }}"/>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-user.account-nav current="addresses"/>
    </div>
    <div class="col-span-8 bg-gray-100">
        <div class="grid grid-cols-4 gap-4">
            @foreach($user->addresses as $address)
                <div class="m-4">
                    <x-user.address-form
                            action="{{ route('address.update', $address->id) }}"
                            addressId="{{ $address->id }}"
                            form-title="{{ $address->title}}"
                            title="{{ $address->title}}"
                            country="{{$address->country}}"
                            city="{{$address->city}}"
                            street="{{$address->street}}"
                            zip="{{$address->zip}}"
                            phone="{{$address->phone}}"
                            isDefault="{{ $address->is_default }}"
                    />
                </div>
            @endforeach
            <div class="m-4">
                <x-user.address-form form-title="{{ __('New address') }}" action="{{ route('address.store') }}"/>
            </div>
        </div>
    </div>
</div>
