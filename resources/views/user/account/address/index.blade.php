<x-header title="{{ __('Addresses') }}"/>
<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="addresses"/>
    <div class="col-span-9 bg-gray-100">
        <div class="grid grid-cols-4 gap-4">
            @php /** @var App\Models\Address $address */@endphp
            @foreach($user->addresses as $address)
                <div class="m-4">
                    <x-user.address-form
                            :address="$address"
                            action="{{ route('address.update', $address->id) }}"
                    />
                </div>
            @endforeach
            <div class="m-4">
                <x-user.address-form/>
            </div>
        </div>
    </div>
</div>
