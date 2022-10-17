<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('user.account.index', compact('user'));
    }

    /**
     * @return RedirectResponse
     */
    public function update(): RedirectResponse
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
            'full_name' => ['nullable', 'string', 'max:255'],
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

        if ($data['full_name'] != $user->full_name) {
            $dataToUpdate['full_name'] = $data['full_name'];
        }

        if ($data['new_password']) {
            $dataToUpdate['password'] = Hash::make($data['new_password']);
        }

        if ($dataToUpdate) {
            $user->update($dataToUpdate);
        }

        return redirect(route('user.account.index'));
    }
}
