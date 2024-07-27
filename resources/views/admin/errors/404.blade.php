<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('404 Error') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white border-b border-gray-200">
        <h1>{{ __('Page Not Found') }}</h1>
        <p>{{ __('The page you are looking for does not exist.') }}</p>
    </div>
</x-guest-layout>
