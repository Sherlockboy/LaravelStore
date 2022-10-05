<x-header/>
<hr class="mt-4 mb-4"/>

<div class="flex justify-center mb-4">
    <h1 class="text-5xl">{{ $category->name }}</h1>
</div>
<hr class="mt-4 mb-4"/>

<div class="grid grid-cols-12 gap-4">
    @foreach($category->products as $product)
        <div class="col-span-3 ml-4 mr-4">
            <div>
                <a href="/product/{{ $product->id }}">
                    <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}">
                </a>

                <div class="flex justify-center">
                    <div>
                        <a href="/product/{{ $product->id }}"><p class="text-xl">{{ $product->name }}</p></a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div>
                        {{ $product->price }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>