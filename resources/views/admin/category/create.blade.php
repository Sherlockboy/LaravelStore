<x-header title="{{ __('Create Category') }}"/>
<x-main-form>
    <p class="text-center">{{ __('Create Category') }}</p>
    <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-4">
                {{ __('Create new Category') }}
            </x-primary-button>
        </div>
    </form>
</x-main-form>


