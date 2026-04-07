<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-sm text-gray-500 mt-1">Sign in to access your dashboard</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="email"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="!text-sm !font-semibold !text-gray-700" />
            <x-text-input id="password"
                class="block mt-1.5 w-full !rounded-xl !border-gray-200 !bg-gray-50/50 focus:!border-maroon-500 focus:!ring-maroon-500 !py-3 !px-4 transition-all duration-200"
                type="password" name="password" required autocomplete="current-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded-md border-gray-300 text-maroon-600 shadow-sm focus:ring-maroon-500 w-4 h-4"
                    name="remember">
                <span class="ms-2 text-sm text-gray-500 font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-maroon-600 hover:text-maroon-700 font-semibold transition-colors"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full mt-6 px-6 py-3.5 bg-gradient-to-r from-maroon-500 to-maroon-600 text-white rounded-xl hover:from-maroon-600 hover:to-maroon-700 transition-all duration-300 font-bold shadow-md hover:shadow-lg hover:scale-[1.01] text-sm">
            {{ __('Sign In') }}
        </button>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-maroon-600 hover:text-maroon-700 font-bold transition-colors">
                    Register here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
