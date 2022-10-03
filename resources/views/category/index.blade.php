<x-header/>
<div class="grid grid-cols-12 gap-4">
    @foreach($category->products as $product)
        <div class="col-span-3">
            <div>
                <a href="/product/{{ $product->id }}">
                    <p style="font-weight: bold">{{ $product->name }}</p>
                </a>
            </div>
            <div>
                {{ $product->price }}
            </div>
        </div>
    @endforeach
</div>