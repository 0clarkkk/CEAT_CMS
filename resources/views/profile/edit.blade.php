<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-maroon-400 to-maroon-600 rounded-xl flex items-center justify-center text-white text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-900 leading-tight">{{ __('Profile Settings') }}</h2>
                <p class="text-sm text-gray-500">Manage your account information and security</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-card sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="h-1 bg-gradient-to-r from-maroon-500 via-primary-500 to-maroon-500"></div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-card sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="h-1 bg-gradient-to-r from-primary-500 via-maroon-500 to-primary-500"></div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-card sm:rounded-2xl overflow-hidden border border-gray-100 border-red-100">
                <div class="h-1 bg-gradient-to-r from-red-400 via-red-500 to-red-400"></div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
