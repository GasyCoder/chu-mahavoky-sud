    <!-- Barre de recherche -->
    <div class="relative flex justify-center mb-6" data-aos="fade-up">
        <div class="relative w-full max-w-2xl">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fas fa-search text-gray-dark opacity-60"></i>
            </div>
            <input
                wire:model.live="searchQuery"
                type="text"
                placeholder="Rechercher un service..."
                class="w-full py-3 pl-12 pr-10 text-sm transition-all border rounded-xl shadow-sm border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20"
            >
            @if($searchQuery)
            <button wire:click="resetSearch" class="absolute inset-y-0 right-0 flex items-center pr-4 transition">
                <span class="flex items-center justify-center w-6 h-6 bg-primary/10 text-primary rounded-full text-xs">
                    <i class="fas fa-times"></i>
                </span>
            </button>
            @endif
        </div>
    </div>
    @if(!empty($searchQuery))
        <div class="flex items-center justify-between px-4 py-2 mb-4 text-sm rounded-xl text-primary bg-primary/10 md:hidden">
            <span class="font-medium">{{ $totalResults }} resultat{{ $totalResults > 1 ? 's' : '' }}</span>
            <button wire:click="resetSearch" type="button" class="flex items-center px-2 py-1 text-xs text-white rounded-lg bg-primary hover:bg-primary/90">
                <i class="mr-1 fas fa-times"></i> Effacer
            </button>
        </div>
    @endif
