<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyan-100">
<div class="font-sans text-gray-900 antialiased">
    <div class="container">
        <div class="row">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <div class="text-sm text-gray-700 dark:text-gray-500">
                            <a href="{{ route('cart.index') }}" class="ml-4">{{'Cart'}}</a>
                            <a href="{{ url('/account') }}" class="ml-4">{{ __('Account') }}</a>
                            <a href="{{ url('/logout') }}" class="ml-4">{{ __('Logout') }}</a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

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
                @admin
                <x-admin-navigation/>
                @endadmin
                @foreach($categories as $category)
                    <li>
                        <div>
                            <a href="/category/{{ $category->id }}">{{ $category->name }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </header>
    <div class="flex justify-center my-4 bg-blue-200 sm:rounded-lg">
        <h1 class="text-5xl my-4">{{ __($title ?? config('app.name', 'Laravel')) }}</h1>
    </div>
</div>
</body>
</html>