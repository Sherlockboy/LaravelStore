<div>
    <x-dropdown>
        <x-slot name="trigger">
            <button class="">
                <div>{{ __('Admin') }}</div>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link href="{{ route('category.create') }}">{{ __("Add new Category") }}</x-dropdown-link>
            <x-dropdown-link href="{{ route('product.create') }}">{{ __("Add new Product") }}</x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>
