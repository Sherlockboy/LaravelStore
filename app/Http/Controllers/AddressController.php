<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.account-address', compact('user'));
    }

    public function store()
    {
        $data = $this->prepareAddressData();
        $data['user_id'] = auth()->user()->id;

        Address::create($data);

        return redirect(url()->previous());
    }

    public function update(Address $address)
    {
        $data = $this->prepareAddressData();
        $address->update($data);

        return redirect(url()->previous());
    }

    public function delete(Address $address)
    {
        $addressTitle = $address->title;
        $address->delete();
        return response()->json(['title' => $addressTitle]);
    }


    protected function prepareAddressData(): array
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
