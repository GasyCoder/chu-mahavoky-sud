    <!-- Barre de recherche -->
    <div class="relative flex justify-center mb-6" data-aos="fade-up">
        <div class="relative w-full max-w-2xl">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fas fa-search text-turquoise opacity-60"></i>
            </div>
            <input
                wire:model.live="searchQuery"
                type="text"
                placeholder="Rechercher un service..."
                class="w-full py-3 pl-12 pr-10 text-sm transition-all border-2 rounded-full shadow-sm border-turquoise/20 focus:border-turquoise focus:ring-1 focus:ring-turquoise/30"
            >
            @if($searchQuery)
            <button wire:click="resetSearch" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 transition hover:text-turquoise">
                <i class="fas fa-times"></i>
            </button>
            @endif
        </div>
    </div>
    @if(!empty($searchQuery))
        <div class="flex items-center justify-between px-4 py-2 mb-4 text-sm rounded-lg text-turquoise-800 bg-turquoise/10 md:hidden">
            <span class="font-medium">{{ $totalResults }} résultat{{ $totalResults > 1 ? 's' : '' }}</span>
            <button wire:click="resetSearch" type="button" class="flex items-center px-2 py-1 text-xs text-white rounded bg-turquoise hover:bg-turquoise-600">
                <i class="mr-1 fas fa-times"></i> Effacer
            </button>
        </div>
    @endif
