@php /** @var \App\Models\Product $product */ @endphp
<x-header title="{{ __('Edit product ' . $product->name) }}"/>
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="products"/>
    <div class="col-span-9 bg-blue-200 sm:rounded-lg">
        <div class="mt-6 mx-6">
            <a href="{{ route('admin.product.index') }}"> {{ __('Back') }}</a>
        </div>
        <div class=" flex flex-col sm:justify-center items-center my-6 sm:pt-0">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4 col-start-3">
                    <div class="flex justify-center">
                        <img src="/storage/{{$product->image}}" width="">
                    </div>
                </div>
                <div class="col-span-4">
                    <div class="w-full sm:max-w-md p-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        <form method="POST" action="{{ route('admin.product.update', $product->id) }}"
                              enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Name')"/>

                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                              value="{{ $product->name }}" required autofocus/>

                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Price')"/>

                                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                              value="{{ $product->price }}" required autofocus/>

                                <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')"/>

                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                              value="{{ $product->description }}" required autofocus/>

                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>

                            <div>
                                <label for="category">{{ __('Categories') }}</label>
                                <select id="category" class="block mt-1 w-full" name="category[]" required
                                        multiple="multiple"
                                        size="5">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(in_array($category->id, $productCategoryIds))>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <x-input-error :messages="$errors->get('category')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image')"/>

                                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                                              value="{{ $product->image }}" autofocus/>

                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>

                            <div class="flex items-center justify-center mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit Product') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

