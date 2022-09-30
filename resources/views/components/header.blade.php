<x-guest-layout/>
<div class="container">
    <div class="row">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
<header>
    <div class="flex mx-auto max-w-screen-xl mt-6">
        <ul class="flex lg:space-x-8">
            <li>
                <a href="/">{{ __('Home') }}</a>
            </li>
            @foreach($categories as $category)
                <li>
                    <div class="dropdown-menu">
                        <a href="/category/{{ $category->id }}">{{ $category->name }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</header>