@extends('layouts.login')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-gray-300 text-sm">Sign in to continue to your account</p>
        </div>

        <!-- Email Input -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <input 
                id="email" 
                type="email" 
                name="email" 
                placeholder="Email Address" 
                class="input-field w-full pl-10 py-3 rounded-lg @error('email') border-red-500 @enderror" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
            >
            @error('email')
                <div class="text-red-400 text-sm mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <input 
                id="password" 
                type="password" 
                name="password" 
                placeholder="Password" 
                class="input-field w-full pl-10 py-3 rounded-lg @error('password') border-red-500 @enderror" 
                required 
                autocomplete="current-password"
            >
            @error('password')
                <div class="text-red-400 text-sm mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center text-white/70 text-sm">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    name="remember" 
                    class="mr-2 rounded bg-white/20 border-transparent focus:border-transparent focus:bg-white/30 text-white"
                >
                {{ __('Remember me') }}
            </label>
            <a href="{{ route('password.request') }}" class="text-white/70 hover:text-white text-sm transition duration-300">
                Forgot Password?
            </a>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('register') }}" class="text-white/70 hover:text-white text-sm transition duration-300">
                Don't have an account?
            </a>
            <button 
                type="submit" 
                class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105"
            >
                Log In
            </button>
        </div>
    </form>

    <script>
        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            
            const toggleBtn = document.createElement('button');
            toggleBtn.innerHTML = `
                <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            `;
            toggleBtn.type = 'button';
            toggleBtn.classList.add('absolute', 'inset-y-0', 'right-0', 'pr-3', 'flex', 'items-center', 'z-10');
            
            passwordField.parentNode.classList.add('relative');
            passwordField.parentNode.insertBefore(toggleBtn, passwordField.nextSibling);

            toggleBtn.addEventListener('click', function() {
                passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
            });
        });
    </script>
@endsection