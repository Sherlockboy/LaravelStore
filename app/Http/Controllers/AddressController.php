<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Rules\PhoneNumber;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AddressController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.account.address.index', compact('user'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        $data = $this->prepareAddressData();
        $this->resolveOnlyOneDefaultAddress($data);

        $data['user_id'] = auth()->user()->id;

        Address::create($data);

        return redirect(url()->previous());
    }

    /**
     * @param Address $address
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Address $address)
    {
        $data = $this->prepareAddressData();

        if ((!$address->is_default && $data['is_default'])) {
            $this->resolveOnlyOneDefaultAddress($data);
        }

        $address->update($data);

        return redirect(url()->previous());
    }

    /**
     * @param Address $address
     * @return JsonResponse
     */
    public function delete(Address $address)
    {
        $addressTitle = $address->title;
        $address->delete();
        return response()->json(['title' => $addressTitle]);
    }

    /**
     * As user can have only one default address, previous default address should be marked as non-default.
     * @param $data
     * @return void
     */
    private function resolveOnlyOneDefaultAddress($data): void
    {
        if ($data['is_default']) {
            $address = Address::where('user_id', '=', auth()->user()->id)
                ->where('is_default', '=', 1)
                ->get()
                ->first();

            $address->update(['is_default' => 0]);
        }
    }

    /**
     * Prepare address data before creating/updating address
     * @return array
     */
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
