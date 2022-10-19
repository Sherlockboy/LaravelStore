<x-header title="Wishlist"/>
@php /** @var \App\Models\Wishlist $wishlist */ @endphp

<div class="grid grid-cols-12 gap-4">
    <x-user.account-nav current="wishlist"/>
    <div class="col-span-9 bg-blue-200 sm:rounded-lg">
        @if($wishlist->items->count())
            <div class="grid grid-rows">
                <div class="grid grid-rows gap-4">
                    <!-- Grid header -->
                    <div class="grid grid-cols-8 gap-4 mx-4 my-4 ">
                        <div class="col-span-2 flex justify-center">
                            <p class="text-xl">{{ __('Product image') }}</p>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <p class="text-xl">{{ __('Product name') }}</p>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <p class="text-xl">{{ __('Price') }}</p>
                        </div>
                    </div>
                    <hr class="border-gray-100"/>
                    <!-- Products -->
                    @foreach($wishlist->items as $item)
                        <div class="grid grid-cols-8 gap-4 mx-6 max-h-50">
                            <div class="col-span-2 flex justify-center ">
                                <a href="/product/{{ $item->product->id }}">
                                    <img class="max-h-40" src="/storage/{{ $item->product->image }}"
                                         alt="{{ $item->product->name }}">
                                </a>
                            </div>
                            <div class="col-span-2 flex justify-center">
                                <a href="/product/{{ $item->product->id }}">
                                    <p class="">{{ $item->product->name }}</p>
                                </a>
                            </div>
                            <div class="col-span-2 flex justify-center">
                                <p>
                                    {{ number_format($item->product->price, 2) }}
                                </p>
                            </div>
                            <div class="col-span-2">
                                <div class="grid grid-rows flex justify-center">
                                    <div class="flex justify-center">
                                        <x-buttons.remove-from-wishlist-button item-id="{{$item->id}}"/>
                                    </div>
                                    <div class="flex justify-center">
                                        <x-buttons.add-to-cart-button product-id="{{$item->product->id}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-gray-100"/>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty wishlist -->
            <div class="grid grid-rows gap-4 m-4">
                <div class="grid gap-4 m-4">
                    <p class="text-gray-700 text-xl text-center">{{ __('Your wishlist is empty') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
