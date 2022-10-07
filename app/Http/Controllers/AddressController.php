<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function update()
    {
        $data = request()->validate([
            'country' => ['required'],
            'city' => ['required'],
            'street' => ['required'],
            'zip' => ['required'],
            'phone' => ['required'],
        ]);

        $user = auth()->user();
        $data['user_id'] = $user->id;

        $user->address ? $user->address->update($data) : Address::create($data);

        return redirect(route('user.account'));
    }
}
