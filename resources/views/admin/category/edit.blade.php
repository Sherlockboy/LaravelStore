@php /** @var \App\Models\Category $category */@endphp
<x-header title="{{ __('Edit Category ' . $category->name) }}"/>
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="categories"/>
    <div class="col-span-9 bg-blue-200 sm:rounded-lg">
        <div class="mt-6 mx-6">
            <a href="{{ route('admin.category.index') }}"> {{ __('Back') }}</a>
        </div>
        <x-main-form>
            <p class="text-center">{{ __('Edit Category ' . $category->name) }}</p>
            <form method="POST" action="{{ route('admin.category.update', $category->id) }}"
                  enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Name')"/>

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  value="{{$category->name}}" required autofocus/>

                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Update Category') }}
                    </x-primary-button>
                </div>
            </form>
        </x-main-form>
    </div>
</div>

