<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-dark">
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" class="text-sm font-medium text-dark" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('current_password') border-pink @enderror" autocomplete="current-password" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('current_password')" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-sm font-medium text-dark" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('password') border-pink @enderror" autocomplete="new-password" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-dark" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise" autocomplete="new-password" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="px-4 py-2 bg-button text-white rounded-lg hover:bg-turquoise-dark transition">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-turquoise"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
