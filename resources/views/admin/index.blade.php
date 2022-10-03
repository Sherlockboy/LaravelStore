<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h1>Admin panel</h1>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="mt-4">
                <x-input-label for="username" :value="__('Username')"/>

                <x-text-input id="username" class="block mt-1 w-full"
                              type="text"
                              name="username"
                              required autocomplete="current-username"/>

                <x-input-error :messages="$errors->get('username')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <x-primary-button class="mt-6">
                {{ __('Log in') }}
            </x-primary-button>
        </form>
    </x-auth-card>
</x-guest-layout>