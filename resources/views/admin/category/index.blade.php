<x-header title="{{__('Admin Panel: Categories')}}"/>
<div class="grid grid-cols-12">
    <div class="col-span-2 col-start-6 justify-center flex mb-4 text-xl bg-blue-200 sm:rounded-lg">
        <x-primary-button class="my-4">
            <a href="{{ route('admin.category.create') }}">{{ __('Add new Category') }}</a>
        </x-primary-button>
    </div>
</div>
<div class="grid grid-cols-12 gap-4">
    <x-admin.admin-nav current="categories"/>
    <div class="col-span-9 bg-blue-200 sm:rounded-lg">
        <div class="grid grid-rows">
            <div class="grid grid-cols-3 border border-gray-100">
                <div class="m-1 text-center text-xl">{{ __('Category Id') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Category Name') }}</div>
                <div class="m-1 text-center text-xl">{{ __('Actions') }}</div>
            </div>
            @php /** @var \App\Models\Category $category */ @endphp
            @foreach($categories as $category)
                <div class="grid grid-cols-3 border border-gray-100
                {{ $loop->odd ? 'bg-gray-200' : 'bg-gray-300'}}">
                    <div class="m-1 text-center">{{ $category->id }}</div>
                    <div class="m-1 text-center">{{ $category->name }}</div>
                    <div class="m-1 text-center">
                        <div class="grid grid-rows">
                            <div>
                                <a href="{{ route('admin.category.edit', $category->id) }}">{{__('Edit')}}</a>
                            </div>
                            <div>
                                <x-admin.delete-action
                                        entity-id="{{$category->id}}"
                                        entity-name="category"/>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="flex justify-center m-4">
    {{ $categories->links()}}
</div>