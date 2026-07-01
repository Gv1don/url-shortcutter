<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Reset password</h2>
        <p class="mt-1 text-sm text-gray-500">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
            {{ __('Send reset link') }}
        </button>

        <p class="text-center text-sm text-gray-500">
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Back to sign in</a>
        </p>
    </form>
</x-guest-layout>