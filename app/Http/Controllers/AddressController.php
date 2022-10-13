<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Rules\PhoneNumber;

class AddressController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.account.address.index', compact('user'));
    }

    public function store()
    {
        $data = $this->prepareAddressData();

        $this->resolveOnlyOneDefaultAddress($data);

        $data['user_id'] = auth()->user()->id;

        if ($data['is_default']) {
            foreach (auth()->user()->addresses as $address) {
                if ($address->is_default) {
                    $address->update(['is_default' => 0]);
                }
            }
        }

        Address::create($data);

        return redirect(url()->previous());
    }

    public function update(Address $address)
    {
        $data = $this->prepareAddressData();

        if (!($address->is_default && $data['is_default'])) {
            $this->resolveOnlyOneDefaultAddress($data);
        }

        $address->update($data);

        return redirect(url()->previous());
    }

    public function delete(Address $address)
    {
        $addressTitle = $address->title;
        $address->delete();
        return response()->json(['title' => $addressTitle]);
    }

    private function resolveOnlyOneDefaultAddress($data): void
    {
        if ($data['is_default']) {
            foreach (auth()->user()->addresses as $address) {
                if ($address->is_default) {
                    $address->update(['is_default' => 0]);
                }
            }
        }
    }

    private function prepareAddressData(): array
    {
        $data = request()->validate([
            'title' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'zip' => ['required'],
            'phone' => ['required', new PhoneNumber()],
            'is_default' => ['nullable']
        ]);

        $data['is_default'] = array_key_exists('is_default', $data) && $data['is_default'] === 'on' ? 1 : 0;

        return $data;
    }
}
