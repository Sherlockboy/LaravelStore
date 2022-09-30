<x-header header-type="1"/>
<div class="grid grid-cols-12 gap-4">
        @foreach($category->products as $product)
            <div class="col-span-3">
                <div>
                    <p style="font-weight: bold">{{ $product->name }}</p>
                </div>
                <div>
                    {{ $product->price }}
                </div>
            </div>
        @endforeach

</div>