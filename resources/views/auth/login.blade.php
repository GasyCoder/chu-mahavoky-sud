<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 p-4 bg-turquoise text-white rounded-lg" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-dark" />
            <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('email') border-pink @enderror" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-pink" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-dark" />
            <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('password') border-pink @enderror" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-pink" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray text-turquoise focus:ring-turquoise" name="remember">
                <span class="ms-2 text-sm text-dark">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3 px-4 py-2 bg-button text-white rounded-lg hover:bg-turquoise-dark transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
