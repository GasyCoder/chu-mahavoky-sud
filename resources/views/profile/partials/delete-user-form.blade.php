<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-dark">
            {{ __("Once your account is deleted, all of its resources and data will be permanently deleted.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6" onsubmit="return confirm('Are you sure you want to delete your account?');">
        @csrf
        @method('delete')

        <!-- Password Confirmation -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-dark" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('password') border-pink @enderror" autocomplete="current-password" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('password')" />
        </div>

        <!-- Delete Button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="px-4 py-2 bg-pink text-white rounded-lg hover:bg-pink-dark transition">
                {{ __('Delete Account') }}
            </x-primary-button>
        </div>
    </form>
</section>
