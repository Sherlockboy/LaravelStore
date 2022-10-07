<x-header title="{{ __('Create Product') }}"/>
<x-main-form>
    <p class="text-center">{{ __('Create Product') }}</p>
    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')"/>

            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                          autofocus/>

            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')"/>

            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required
                          autofocus/>

            <x-input-error :messages="$errors->get('price')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')"/>

            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                          :value="old('description')" required autofocus/>

            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
        </div>

        <!-- Add category -->

        <div>
            <label for="category">{{ __('Categories') }}</label>

            <select id="category" class="block mt-1 w-full" name="category[]" required multiple="multiple" size="5">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('category')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="image" :value="__('Image')"/>

            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required
                          autofocus/>

            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-4">
                {{ __('Create new Product') }}
            </x-primary-button>
        </div>
    </form>
</x-main-form>

