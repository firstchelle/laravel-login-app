<x-app-layout>
    <!-- Header slot -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="shadow-sm sm:rounded-lg mt-6 p-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Selamat datang, " . Auth::user()->name . " !!") }}
        </h2>
    </div>
</x-app-layout>
