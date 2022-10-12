<x-header title="{{__('Admin Panel: Products')}}"/>
<div class="justify-center flex mb-4 text-xl bg-blue-100 sm:rounded-lg">
    <x-primary-button class="my-4">
        <a href="{{ route('admin.product.create') }}">{{ __('Add new Product') }}</a>
    </x-primary-button>
</div>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 col-start-2 bg-blue-200 sm:rounded-lg">
        <x-admin.admin-nav current="products"/>
    </div>
    <div class="col-span-8 bg-blue-200 sm:rounded-lg">
        <div class="grid grid-rows">
            <div class="grid grid-cols-5 border border-gray-100">
                <div class="m-1 text-center text-xl">{{ __('Product Id') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Image') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Product Name') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Categories') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Actions') }}</div>
            </div>
            @foreach($products as $product)
                <div class="grid grid-cols-5 border border-gray-100">
                    <div class="m-1 text-center">{{ $product->id }}</div>
                    <div class="m-1 text-center">
                        <img src="/storage/{{ $product->image }}">
                    </div>
                    <div class="m-1 text-center">{{ $product->name }}</div>
                    <div class="m-1 text-center">
                        <div class="grid grid-rows">
                            @foreach($product->categories as $category)
                                <div>{{ $category->name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="m-1 text-center">
                        <div class="grid grid-rows">
                            <div><a href="{{ route('admin.product.edit', $product->id) }}">{{ __('Edit') }}</a></div>
                            <div>
                                <x-admin.delete-action
                                        entity-id="{{$product->id}}"
                                        entity-name="product"/>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>