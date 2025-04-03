<div>
    <form wire:submit.prevent="submitForm">
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-dark">Nom complet <span class="text-purple">*</span></label>
                <input wire:model.live="name" type="text" id="name" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none @error('name') border-red-600 @enderror">
                @error('name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-dark">Email <span class="text-purple">*</span></label>
                <input wire:model.live="email" type="email" id="email" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none @error('email') border-red-600 @enderror">
                @error('email') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="phone" class="block mb-2 text-dark">Téléphone</label>
            <input wire:model.live="phone" type="tel" id="phone" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none @error('phone') border-red-600 @enderror">
            @error('phone') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="subject" class="block mb-2 text-dark">Sujet <span class="text-purple">*</span></label>
            <select wire:model.live="subject" id="subject" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none @error('subject') border-red-600 @enderror">
                <option value="">Sélectionnez un sujet</option>
                <option value="Demande d'informations">Demande d'informations</option>
                <option value="Rendez-vous">Rendez-vous</option>
                <option value="Carrières">Carrières</option>
                <option value="Commentaires">Commentaires</option>
                <option value="Autre">Autre</option>
            </select>
            @error('subject') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="message" class="block mb-2 text-dark">Message <span class="text-purple">*</span></label>
            <textarea wire:model.live="message" id="message" rows="6" class="w-full rounded-md border border-gray p-3 focus:border-purple focus:ring focus:ring-purple/20 focus:outline-none @error('message') border-red-600 @enderror"></textarea>
            @error('message') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input wire:model.live="privacy" id="privacy" type="checkbox" class="w-4 h-4 rounded border border-gray focus:ring-purple @error('privacy') border-red-600 @enderror">
                </div>
                <label for="privacy" class="ml-2 text-sm text-gray-dark">
                    J'accepte que mes données soient traitées conformément à la politique de confidentialité du site.
                </label>
            </div>
            @error('privacy') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        @if($successMessage)
        <div class="p-4 mb-6 border rounded-lg bg-turquoise/10 text-turquoise border-turquoise/20">
            {{ $successMessage }}
        </div>
        @endif

        @error('form')
        <div class="p-4 mb-6 text-red-600 bg-red-100 border border-red-200 rounded-lg">
            {{ $message }}
        </div>
        @enderror

        <button
            type="submit"
            class="w-full py-3 font-medium text-white transition-opacity rounded-md bg-gradient-to-r from-purple to-turquoise hover:opacity-90"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75"
        >
            <span wire:loading.remove>Envoyer le message</span>
            <span wire:loading wire:target="submitForm">
                <svg class="inline-block w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Envoi en cours...
            </span>
        </button>
    </form>
</div>
