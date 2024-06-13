<!-- resources/views/components/custom-login.blade.php -->
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-8 bg-white shadow-md rounded-lg">
        <div class="flex justify-center">
            <img src="{{ asset('images/your-logo.png') }}" alt="Your Logo" class="w-20 h-20">
        </div>
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">
            {{ __('Sign in to your account') }}
        </h2>
        <form method="POST" action="{{ route('filament.auth.login') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        {{ __('Email address') }}
                    </label>
                    <input id="email" name="email" type="email" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        {{ __('Password') }}
                    </label>
                    <input id="password" name="password" type="password" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="remember_me" class="block ml-2 text-sm text-gray-900">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('filament.auth.password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Sign in') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
