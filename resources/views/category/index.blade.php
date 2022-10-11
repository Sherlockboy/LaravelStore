<x-header title="{{  $category->name }}"/>
<hr class="mt-4 mb-4"/>
<div class="grid grid-cols-12 gap-4">
    @foreach($category->products as $product)
        <div class="col-span-3 ml-4 mr-4">
            <div class="grid grid-rows-12">
                <div class="flex justify-center row-span-2">
                    <a href="/product/{{ $product->id }}">
                        <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}">
                    </a>
                </div>
                <div class="flex justify-center row-span-2">
                    <div>
                        <a href="/product/{{ $product->id }}"><p class="text-xl">{{ $product->name }}</p></a>
                    </div>
                </div>
                <div class="flex justify-center row-span-2">
                    <div>
                        {{ $product->price }}
                    </div>
                </div>
                <div class="flex justify-center row-span-2">
                    @auth()
                        <x-checkout.add-to-cart-button>
                            <x-slot name="productId">
                                {{ $product->id }}
                            </x-slot>
                        </x-checkout.add-to-cart-button>
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>