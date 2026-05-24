<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Payroll Management System</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

        <body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
        style='background-image: url("/images/background.jpg");'>
      
        <div class="bg-white/25 backdrop-blur-sm p-10 rounded shadow w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-10">

            <div class="flex flex-col justify-center text-center">
                <h1 class="text-3xl text-white font-bold mb-6">
                    Payroll Management System
                </h1>

                <p class="text-white mb-6">
                    Manage employees, payroll, attendance, reports, and audit logs.
                </p>

                <a href="{{ route('register') }}"
                class="bg-green-500 text-white px-5 py-2 rounded mx-auto">
                    Register
                </a>
            </div>

            <div>
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.svg') }}"
                        alt="Logo"
                        class="w-32 h-32">
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-white" />
                        <x-text-input id="email" class="block mt-1 w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="text-white" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-white">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-white underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <x-primary-button class="ms-3">
                            Log in
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>