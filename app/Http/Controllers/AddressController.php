<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function update()
    {
        $data = request()->validate([
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'zip' => ['required'],
            'phone' => ['required', 'regex:~\+(\d)+~'],
        ]);

        $user = auth()->user();
        $data['user_id'] = $user->id;

        $user->address ? $user->address->update($data) : Address::create($data);

        return redirect(route('user.account'));
    }
}
