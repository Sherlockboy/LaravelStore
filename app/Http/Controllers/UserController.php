<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.account.index', compact('user'));
    }

    public function update()
    {
        //TODO Process error messages
        // Refactor using Request validate php artisan make:request
        $user = auth()->user();
        $data = request()->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'new_password' => ['nullable', 'confirmed', 'different:current_password', Password::default()],
            'current_password' => [
                'nullable',
                'current_password',
                Rule::requiredIf(function (){ return request('new_password');})
            ],
        ]);

        $dataToUpdate = [];
        if ($data['username'] != $user->username) {
            $dataToUpdate['username'] = $data['username'];
        }

        if ($data['email'] != $user->email) {
            $dataToUpdate['email'] = $data['email'];
            //TODO: Send confirmation email
        }

        if ($data['first_name'] != $user->first_name) {
            $dataToUpdate['first_name'] = $data['first_name'];
        }

        if ($data['last_name'] != $user->last_name) {
            $dataToUpdate['last_name'] = $data['last_name'];
        }

        if ($data['new_password']) {
            $dataToUpdate['password'] = Hash::make($data['new_password']);
        }

        if ($dataToUpdate) {
            $user->update($dataToUpdate);
        }

        return redirect(route('user.account'));
    }
}
