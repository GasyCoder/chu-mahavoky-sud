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
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-dark" />
            <div class="relative mt-1">
                <x-text-input 
                    id="password" 
                    class="block w-full rounded-md border-gray p-2 pr-10 focus:ring-turquoise focus:border-turquoise @error('password') border-pink @enderror" 
                    type="password"
                    x-bind:type="show ? 'text' : 'password'" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                />
                <button 
                    type="button" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-turquoise transition-colors focus:outline-none" 
                    @click="show = !show"
                    aria-label="Toggle password visibility"
                >
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
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
