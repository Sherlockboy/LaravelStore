<x-header/>
<hr class="mt-4 mb-4"/>

<div class="flex justify-center mb-4">
    <h1 class="text-5xl">{{ __('Shopping cart') }}</h1>
</div>
<hr class="mt-4 mb-4"/>

{{--<table class="border-separate table-auto">--}}
{{--    @foreach($user->cart->cartItems as $cartItem)--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <a href="/product/{{ $cartItem->product->id }}">--}}
{{--                    <img src="/storage/{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}">--}}
{{--                </a>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <a href="/product/{{ $cartItem->product->id }}"><p class="text-xl">{{ $cartItem->product->name }}</p></a>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <a href="/product/{{ $cartItem->product->id }}">--}}
{{--                    {{ $cartItem->product->price }}--}}
{{--                </a>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
@if($user->cart->cartItems->count())
    <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6 ms-6 bg-blue-200">
        <div class="grid grid-cols-10 gap-4 ml-6 mr-6 ">
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Product image') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Product name') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Price') }}</p>
            </div>
            <div class="col-span-2 flex justify-center">
                <p class="text-xl">{{ __('Quantity') }}</p>
            </div>
        </div>
        @foreach($user->cart->cartItems as $cartItem)
            <div class="grid grid-cols-10 gap-4  ml-6 mr-6">
                <div class="col-span-2 flex justify-center">
                    <a href="/product/{{ $cartItem->product->id }}">
                        <img src="/storage/{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}">
                    </a>
                </div>
                <div class="col-span-2 flex justify-center">
                    <a href="/product/{{ $cartItem->product->id }}"><p
                                class="text-xl">{{ $cartItem->product->name }}</p>
                    </a>
                </div>
                <div class="col-span-2 flex justify-center">
                    <a href="/product/{{ $cartItem->product->id }}">
                        {{ $cartItem->product->price }}
                    </a>
                </div>
                <div class="col-span-2 flex justify-center">

                </div>
                <div class="col-span-2 flex justify-center">
                    <x-cart.remove-from-cart>
                        <x-slot name="cartItemId">{{ $cartItem->id }}</x-slot>
                    </x-cart.remove-from-cart>
                </div>
            </div>
            <hr class="border-gray-100"/>
        @endforeach
        <div class="grid grid-cols-12 gap-4 ml-6 mr-6">
            <div class="col-span-4 col-start-8">
                <p class="text-xl">{{ __('Final price: ') . "$finalPrice" }}</p>
            </div>
        </div>
    </div>
@else
    <div class="grid grid-rows gap-4 ml-6 mr-6 mb-6 ms-6 bg-blue-100">
        <div class="grid gap-4 ml-6 mr-6 ">
            <p class="text-gray-700 text-xl text-center">{{ __('Your shopping cart is empty') }}</p>
        </div>
    </div>

@endif


