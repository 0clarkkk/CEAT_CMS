<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UPH Engineering') }} - Sign In</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #fdf2f2 0%, #f0f4ff 50%, #fef3f7 100%);
            z-index: -2;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(139, 0, 0, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-30px) translateX(20px); }
        }
        
        .blob-decoration {
            position: fixed;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
            z-index: -1;
        }
        
        .blob-1 {
            width: 400px;
            height: 400px;
            top: 10%;
            left: -100px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.15) 0%, transparent 100%);
            animation: blob1 7s infinite;
        }
        
        .blob-2 {
            width: 350px;
            height: 350px;
            bottom: 10%;
            right: -50px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, transparent 100%);
            animation: blob2 8s infinite;
        }
        
        .blob-3 {
            width: 300px;
            height: 300px;
            bottom: 20%;
            left: 10%;
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, transparent 100%);
            animation: blob3 9s infinite;
        }
        
        @keyframes blob1 {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(20px, -30px); }
            50% { transform: translate(-10px, 20px); }
            75% { transform: translate(15px, 10px); }
        }
        
        @keyframes blob2 {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(-30px, 20px); }
            50% { transform: translate(10px, -25px); }
            75% { transform: translate(-15px, -10px); }
        }
        
        @keyframes blob3 {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(15px, 25px); }
            50% { transform: translate(-20px, -10px); }
            75% { transform: translate(10px, 20px); }
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased relative">
    <!-- Decorative Blur Blobs -->
    <div class="blob-decoration blob-1"></div>
    <div class="blob-decoration blob-2"></div>
    <div class="blob-decoration blob-3"></div>
    
    <!-- Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden" x-data="{ isRegister: false }">
            <div class="flex" x-transition>
                <!-- Left Panel: Welcome Greetings -->
                <div 
                    class="bg-gradient-to-b from-maroon-600 to-maroon-700 flex flex-col items-center justify-center p-8 text-white text-center overflow-hidden transition-all duration-700 ease-in-out"
                    :style="isRegister ? 'flex: 0 0 0%; opacity: 0; visibility: hidden;' : 'flex: 0 0 25%; opacity: 1; visibility: visible;'"
                >
                    <div>
                        <h3 class="text-2xl font-black mb-4 whitespace-nowrap">Welcome!</h3>
                        <p class="text-sm text-maroon-100 leading-relaxed">Sign in to access your dashboard</p>
                    </div>
                </div>

                <!-- Form Container -->
                <div 
                    class="bg-white p-10 md:p-12 overflow-y-auto max-h-screen md:max-h-none transition-all duration-700 ease-in-out"
                    :style="isRegister ? 'flex: 1 1 100%;' : 'flex: 1 1 75%;'"
                >
                    <!-- Login Form -->
                    <div x-show="!isRegister" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-6" :status="session('status')" />

                        <!-- Form Header -->
                        <div class="mb-8">
                            <h2 class="text-3xl font-black text-gray-900 mb-2">Sign In</h2>
                            <p class="text-gray-600 text-sm">Enter your credentials to continue</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                <x-text-input id="email"
                                    class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2.5 !px-4 transition-all duration-200 !text-base"
                                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                    placeholder="you@example.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                <x-text-input id="password"
                                    class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2.5 !px-4 transition-all duration-200 !text-base"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="••••••••" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-maroon-600 shadow-sm focus:ring-maroon-500 w-4 h-4"
                                        name="remember">
                                    <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-maroon-600 hover:text-maroon-700 font-semibold transition-colors"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Sign In Button -->
                            <button type="submit"
                                class="w-full mt-8 px-6 py-2.5 bg-gradient-to-r from-maroon-500 to-maroon-600 text-white rounded-lg hover:from-maroon-600 hover:to-maroon-700 transition-all duration-300 font-bold shadow-md hover:shadow-lg text-base">
                                {{ __('Sign In') }}
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="mt-8 text-center border-t border-gray-200 pt-6">
                            <p class="text-gray-600 text-sm">
                                Don't have an account?
                                <a href="#" @click.prevent="isRegister = true" class="text-maroon-600 hover:text-maroon-700 font-bold transition-colors">
                                    Register here
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Register Form (Full Width) -->
                    <div x-show="isRegister" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                        <!-- Form Header -->
                        <div class="mb-8">
                            <h2 class="text-3xl font-black text-gray-900 mb-2">Create Account</h2>
                            <p class="text-gray-600 text-sm">Register to access UPH Engineering CMS</p>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Name -->
                                <div class="col-span-2">
                                    <x-input-label for="name" :value="__('Full Name')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                    <x-text-input id="name"
                                        class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2 !px-4 transition-all duration-200 !text-sm"
                                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                        placeholder="Enter your full name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                <!-- Email Address -->
                                <div class="col-span-2">
                                    <x-input-label for="reg_email" :value="__('Email Address')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                    <x-text-input id="reg_email"
                                        class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2 !px-4 transition-all duration-200 !text-sm"
                                        type="email" name="email" :value="old('email')" required autocomplete="username"
                                        placeholder="you@example.com" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <x-input-label for="reg_password" :value="__('Password')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                    <x-text-input id="reg_password"
                                        class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2 !px-4 transition-all duration-200 !text-sm"
                                        type="password" name="password" required autocomplete="new-password"
                                        placeholder="••••••••" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirm')" class="!text-sm !font-semibold !text-gray-700 mb-2" />
                                    <x-text-input id="password_confirmation"
                                        class="block w-full !rounded-lg !border-gray-300 !bg-gray-50 focus:!bg-white focus:!border-maroon-500 focus:!ring-maroon-500 !py-2 !px-4 transition-all duration-200 !text-sm"
                                        type="password" name="password_confirmation" required autocomplete="new-password"
                                        placeholder="••••••••" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                </div>
                            </div>

                            <!-- Create Account Button -->
                            <button type="submit"
                                class="w-full mt-6 px-6 py-2 bg-gradient-to-r from-maroon-500 to-maroon-600 text-white rounded-lg hover:from-maroon-600 hover:to-maroon-700 transition-all duration-300 font-bold shadow-md hover:shadow-lg text-base">
                                {{ __('Create Account') }}
                            </button>
                        </form>

                        <!-- Back to Login -->
                        <div class="mt-6 text-center">
                            <p class="text-gray-600 text-sm">
                                Already have an account?
                                <a href="#" @click.prevent="isRegister = false" class="text-maroon-600 hover:text-maroon-700 font-bold transition-colors">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>