<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-3xl font-bold text-indigo-600">{{ $stats['users_count'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Active Portfolios</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['active_portfolios'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Themes</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['themes_count'] }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.themes.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-center">Manage Themes</a>
                    <a href="{{ route('admin.users.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-center">Manage Users</a>
                    <a href="{{ route('admin.settings.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-center">Settings</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

