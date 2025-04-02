<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-dark">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-dark" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('name') border-pink @enderror" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-dark" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray p-2 focus:ring-turquoise focus:border-turquoise @error('email') border-pink @enderror" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-pink" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-dark">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-purple hover:text-purple-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-turquoise">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-turquoise">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="px-4 py-2 bg-button text-white rounded-lg hover:bg-turquoise-dark transition">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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
