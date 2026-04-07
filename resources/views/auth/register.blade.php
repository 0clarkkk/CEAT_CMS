<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
        <p class="text-sm text-gray-500 mt-1">Register to access UPH Engineering CMS</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="name"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-5">
            <x-input-label for="email" :value="__('Email Address')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="email"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="password"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="password" name="password" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="password_confirmation"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
            class="w-full mt-6 px-6 py-3.5 bg-gradient-to-r from-maroon-500 to-maroon-600 text-white rounded-xl hover:from-maroon-600 hover:to-maroon-700 transition-all duration-300 font-bold shadow-md hover:shadow-lg hover:scale-[1.01] text-sm">
            {{ __('Create Account') }}
        </button>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-maroon-600 hover:text-maroon-700 font-bold transition-colors">
                    Sign in here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
